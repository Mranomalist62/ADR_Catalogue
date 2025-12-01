<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    // GET /api/orders - list all orders for authenticated user
    public function index()
    {
        $orders = Order::with(['product', 'promo'])
            ->where('id_pemesan', Auth::id())
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    // GET /api/orders/{id} - show specific order
    public function show($id)
    {
        $order = Order::with(['product', 'promo'])
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

        $product = Product::with('promo')->find($request->id_produk);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // check stock
        if ($request->kuantitas > $product->kuantitas) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock'
            ], 400);
        }

        $promo = $product->promo;

        // calculate total price
        $totalHarga = $product->harga_satuan * $request->kuantitas;
        $potongan = $promo?->potongan_harga ?? 0;
        $totalHargaAfterDiscount = $totalHarga - (($potongan / 100) * $totalHarga);

        // create order with snapshot of promo
        $waktuBerlaku = Carbon::now()->addDay();

        $order = Order::create([
            'id_pemesan' => Auth::id(),
            'id_produk' => $product->id,
            'id_promo' => $promo?->id,
            'nama_promo' => $promo?->nama,
            'potongan_harga' => $potongan,
            'kuantitas' => $request->kuantitas,
            'total_harga' => $totalHargaAfterDiscount,
            'status' => 'pending',
            'waktu_berlaku' => $waktuBerlaku,
            'payment_method' => $request->payment_method
        ]);

        // reduce product stock
        $product->kuantitas -= $request->kuantitas;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order->load(['product', 'promo'])
        ], 201);
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
            'status' => 'sometimes|string|max:100',
        ]);

        if ($request->has('kuantitas')) {
            $product = $order->product;

            $delta = $request->kuantitas - $order->kuantitas;
            if ($delta > $product->kuantitas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock for update'
                ], 400);
            }

            // adjust stock
            $product->kuantitas -= $delta;
            $product->save();

            // update total price with snapshot promo
            $totalHarga = $product->harga_satuan * $request->kuantitas;
            $totalHargaAfterDiscount = $totalHarga - (($order->potongan_harga / 100) * $totalHarga);

            $order->total_harga = $totalHargaAfterDiscount;
            $order->kuantitas = $request->kuantitas;
        }

        if ($request->has('status')) {
            $order->status = $request->status;
        }

        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
            'data' => $order->load(['product', 'promo'])
        ]);
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

        // restore stock
        $product = $order->product;
        $product->kuantitas += $order->kuantitas;
        $product->save();

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully'
        ]);
    }
}
