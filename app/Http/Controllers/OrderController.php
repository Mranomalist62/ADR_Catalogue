<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Get current authenticated user ID based on guard
     */
    private function getAuthUserId()
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->id();
        } elseif (Auth::guard('user')->check()) {
            return Auth::guard('user')->id();
        } elseif (Auth::guard('web')->check()) {
            return Auth::guard('web')->id();
        }

        return null;
    }

    /**
     * Get current authenticated user instance
     */
    private function getAuthUser()
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->user();
        } elseif (Auth::guard('user')->check()) {
            return Auth::guard('user')->user();
        } elseif (Auth::guard('web')->check()) {
            return Auth::guard('web')->user();
        }

        return null;
    }

    /**
     * Check if user is authenticated via any guard
     */
    private function isAuthenticated()
    {
        return Auth::guard('admin')->check() ||
               Auth::guard('user')->check() ||
               Auth::guard('web')->check();
    }

    // GET /api/orders - list all orders for authenticated user
    public function index()
    {
        if (!$this->isAuthenticated()) {
            return response()->json([
                'success' => false,
                'message' => 'Not authenticated'
            ], 401);
        }

        $userId = $this->getAuthUserId();

        $orders = Order::with(['product'])
            ->where('id_pemesan', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
            'guard' => Auth::getDefaultDriver()
        ]);
    }

    // GET /api/orders/{id} - show specific order
    public function show($id)
    {
        if (!$this->isAuthenticated()) {
            return response()->json([
                'success' => false,
                'message' => 'Not authenticated'
            ], 401);
        }

        $userId = $this->getAuthUserId();

        $order = Order::with(['product'])
            ->where('id_pemesan', $userId)
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
        if (!$this->isAuthenticated()) {
            return response()->json([
                'success' => false,
                'message' => 'Not authenticated',
                'debug' => [
                    'admin_check' => Auth::guard('admin')->check(),
                    'user_check' => Auth::guard('user')->check(),
                    'web_check' => Auth::guard('web')->check(),
                    'default_guard' => Auth::getDefaultDriver()
                ]
            ], 401);
        }

        $request->validate([
            'id_produk' => 'required|exists:product,id',
            'kuantitas' => 'required|integer|min:1',
            'payment_method' => 'sometimes|string|in:transfer,qris,cash',
            'address_id' => 'required|exists:address,id' // Note: table name is 'address', not 'addresses'
        ]);

        // Get authenticated user
        $user = $this->getAuthUser();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Verify the address belongs to the authenticated user
        // FIX: Use $user->addresses() instead of Auth::user()->addresses()
        $address = $user->addresses()->find($request->address_id);

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Alamat tidak ditemukan atau tidak milik Anda',
                'debug' => [
                    'user_id' => $user->id,
                    'address_id' => $request->address_id,
                    'addresses_count' => $user->addresses()->count()
                ]
            ], 400);
        }

        // Use transaction to prevent race conditions
        return DB::transaction(function () use ($request, $address, $user) {
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

            // Create order with SNAPSHOT data INCLUDING address
            $order = Order::create([
                'id_pemesan' => $user->id,
                'id_produk' => $product->id,
                'id_alamat' => $address->id,

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
                'payment_method' => $request->payment_method ?? 'transfer',

                // Address snapshot
                'alamat_pengiriman' => $address->desk_alamat,
                'nama_penerima' => $address->nama,
                'telepon_penerima' => $address->telepon
            ]);

            // Reduce product stock
            $product->kuantitas -= $request->kuantitas;
            $product->save();

            Log::info('Order created', [
                'order_id' => $order->id,
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $request->kuantitas,
                'guard' => Auth::getDefaultDriver()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order->load(['product', 'address'])
            ], 201);
        });
    }

    // PUT /api/orders/{id} - update order
    public function update(Request $request, $id)
    {
        if (!$this->isAuthenticated()) {
            return response()->json([
                'success' => false,
                'message' => 'Not authenticated'
            ], 401);
        }

        $userId = $this->getAuthUserId();

        $order = Order::where('id_pemesan', $userId)->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        // Updated validation to include Midtrans statuses
        $request->validate([
            'kuantitas' => 'sometimes|integer|min:1',
            'status' => 'sometimes|string|in:pending,settlement,capture,paid,processing,shipped,delivered,cancelled,expired,deny',
        ]);

        // Use transaction for stock updates
        return DB::transaction(function () use ($request, $order) {
            $product = null;
            $stockChanged = false;

            // Handle quantity changes
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
                $stockChanged = true;

                // Recalculate total price using SNAPSHOT data
                $originalTotal = $order->harga_produk * $request->kuantitas;
                $discountAmount = ($order->potongan_harga / 100) * $originalTotal;
                $totalHargaAfterDiscount = $originalTotal - $discountAmount;

                $order->kuantitas = $request->kuantitas;
                $order->total_harga = $totalHargaAfterDiscount;
            }

            // Handle status changes with Midtrans integration
            if ($request->has('status')) {
                $oldStatus = $order->status;
                $newStatus = $request->status;

                // Define final statuses (no more changes)
                $finalStatuses = ['settlement', 'capture', 'paid', 'delivered', 'cancelled', 'expired', 'deny'];

                // Prevent changing from final status
                if (in_array($oldStatus, $finalStatuses)) {
                    return response()->json([
                        'success' => false,
                        'message' => "Cannot change status from '{$oldStatus}' as it's final"
                    ], 400);
                }

                // Map Midtrans statuses to your app statuses
                $statusMap = [
                    'settlement' => 'paid',
                    'capture' => 'paid',
                    'deny' => 'cancelled',
                    'expire' => 'expired',
                ];

                // Translate Midtrans status if needed
                $mappedStatus = $statusMap[$newStatus] ?? $newStatus;

                // Handle stock logic based on status transitions
                if ($oldStatus == 'pending' && in_array($mappedStatus, ['cancelled', 'expired', 'deny'])) {
                    // Restore stock when payment fails or order is cancelled
                    if (!$product) {
                        $product = Product::where('id', $order->id_produk)
                            ->lockForUpdate()
                            ->first();
                    }

                    if ($product) {
                        $product->kuantitas += $order->kuantitas;
                        $product->save();
                        $stockChanged = true;
                    }

                    // Also update payment expiry if needed
                    if ($mappedStatus == 'expired') {
                        $order->waktu_berlaku = Carbon::now();
                    }

                } elseif ($oldStatus == 'cancelled' && $mappedStatus == 'pending') {
                    // Reactivate order - reduce stock again
                    if (!$product) {
                        $product = Product::where('id', $order->id_produk)
                            ->lockForUpdate()
                            ->first();
                    }

                    if ($product && $order->kuantitas <= $product->kuantitas) {
                        $product->kuantitas -= $order->kuantitas;
                        $product->save();
                        $stockChanged = true;
                        // Reset expiry time
                        $order->waktu_berlaku = Carbon::now()->addDay();
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Insufficient stock to reactivate order'
                        ], 400);
                    }
                }

                // Update order status
                $order->status = $mappedStatus;

                Log::info('Order status updated', [
                    'order_id' => $order->id,
                    'old_status' => $oldStatus,
                    'new_status' => $mappedStatus,
                    'midtrans_status' => $newStatus,
                    'stock_changed' => $stockChanged
                ]);
            }

            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'data' => $order->load(['product', 'address', 'payment'])
            ]);
        });
    }

    // DELETE /api/orders/{id} - cancel order and restore stock
    public function destroy($id)
    {
        if (!$this->isAuthenticated()) {
            return response()->json([
                'success' => false,
                'message' => 'Not authenticated'
            ], 401);
        }

        $userId = $this->getAuthUserId();

        $order = Order::where('id_pemesan', $userId)->find($id);

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
