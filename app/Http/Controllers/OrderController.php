<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    // GET /api/orders - list all orders for authenticated user
    public function index()
    {
        $orders = Order::with(['product']) // Removed 'promo' from with()
            ->where('id_pemesan', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    // GET /api/orders/{id} - show specific order
    public function show($id)
    {
        $order = Order::with(['product']) // Removed 'promo' from with()
            ->where('id_pemesan', Auth::id())
            ->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }

    // POST /api/orders - create new order
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:product,id',
            'kuantitas' => 'required|integer|min:1',
            'payment_method' => 'sometimes|string|in:transfer,qris,cash'
        ]);

        // Use transaction to prevent race conditions
        return DB::transaction(function () use ($request) {
            // Lock product for update to prevent race condition
            $product = Product::where('id', $request->id_produk)
                ->lockForUpdate()
                ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            // Check stock again after lock
            if ($request->kuantitas > $product->kuantitas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock'
                ], 400);
            }

            $promo = $product->promo;

            // Calculate prices
            $hargaProduk = $product->harga_satuan;
            $potongan = $promo?->potongan_harga ?? 0;

            // Calculate total
            $originalTotal = $hargaProduk * $request->kuantitas;
            $discountAmount = ($potongan / 100) * $originalTotal;
            $totalHargaAfterDiscount = $originalTotal - $discountAmount;

            // Set expiry time
            $waktuBerlaku = Carbon::now()->addDay();

            // Create order with SNAPSHOT data
            $order = Order::create([
                'id_pemesan' => Auth::id(),
                'id_produk' => $product->id,
                // Product snapshot
                'nama_produk' => $product->nama,
                'harga_produk' => $hargaProduk,
                // Promo snapshot
                'nama_promo' => $promo?->nama,
                'potongan_harga' => $potongan,
                // Order details
                'kuantitas' => $request->kuantitas,
                'total_harga' => $totalHargaAfterDiscount,
                'status' => 'pending',
                'waktu_berlaku' => $waktuBerlaku,
                'payment_method' => $request->payment_method ?? 'transfer'
            ]);

            // Reduce product stock
            $product->kuantitas -= $request->kuantitas;
            $product->save();

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order->load(['product']) // Removed 'promo' from load()
            ], 201);
        });
    }

    // PUT /api/orders/{id} - update order (only status or kuantitas maybe)
    public function update(Request $request, $id)
    {
        $order = Order::where('id_pemesan', Auth::id())->find($id);
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $request->validate([
            'kuantitas' => 'sometimes|integer|min:1',
            'status' => 'sometimes|string|in:pending,paid,processing,shipped,delivered,cancelled',
        ]);

        // Use transaction for stock updates
        return DB::transaction(function () use ($request, $order) {
            $product = null;

            if ($request->has('kuantitas') && $request->kuantitas != $order->kuantitas) {
                $product = Product::where('id', $order->id_produk)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Product not found'
                    ], 404);
                }

                $delta = $request->kuantitas - $order->kuantitas;

                if ($delta > $product->kuantitas) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Insufficient stock for update'
                    ], 400);
                }

                // Adjust stock
                $product->kuantitas -= $delta;
                $product->save();

                // Recalculate total price using SNAPSHOT data (not current product price)
                $originalTotal = $order->harga_produk * $request->kuantitas;
                $discountAmount = ($order->potongan_harga / 100) * $originalTotal;
                $totalHargaAfterDiscount = $originalTotal - $discountAmount;

                $order->kuantitas = $request->kuantitas;
                $order->total_harga = $totalHargaAfterDiscount;
            }

            if ($request->has('status')) {
                // If changing from pending to cancelled, restore stock
                if ($order->status == 'pending' && $request->status == 'cancelled') {
                    if (!$product) {
                        $product = Product::where('id', $order->id_produk)
                            ->lockForUpdate()
                            ->first();
                    }

                    if ($product) {
                        $product->kuantitas += $order->kuantitas;
                        $product->save();
                    }
                }

                // If changing from cancelled back to pending, reduce stock
                if ($order->status == 'cancelled' && $request->status == 'pending') {
                    if (!$product) {
                        $product = Product::where('id', $order->id_produk)
                            ->lockForUpdate()
                            ->first();
                    }

                    if ($product && $order->kuantitas <= $product->kuantitas) {
                        $product->kuantitas -= $order->kuantitas;
                        $product->save();
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Insufficient stock to reactivate order'
                        ], 400);
                    }
                }

                $order->status = $request->status;
            }

            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'data' => $order->load(['product']) // Removed 'promo' from load()
            ]);
        });
    }

    // DELETE /api/orders/{id} - cancel order and restore stock
    public function destroy($id)
    {
        $order = Order::where('id_pemesan', Auth::id())->find($id);
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        // Use transaction for stock restoration
        return DB::transaction(function () use ($order) {
            // Restore stock if order was pending
            if ($order->status == 'pending') {
                $product = Product::where('id', $order->id_produk)
                    ->lockForUpdate()
                    ->first();

                if ($product) {
                    $product->kuantitas += $order->kuantitas;
                    $product->save();
                }
            }

            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order cancelled successfully'
            ]);
        });
    }

    // Optional: Add a method to check order expiry
    public function checkExpiredOrders()
    {
        $expiredCount = Order::where('status', 'pending')
            ->where('waktu_berlaku', '<', Carbon::now())
            ->count();

        return response()->json([
            'success' => true,
            'expired_orders_count' => $expiredCount
        ]);
    }
}
