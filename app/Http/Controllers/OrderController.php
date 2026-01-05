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

    private function getCurrentGuard()
    {
        if (Auth::guard('admin')->check()) {
            return 'admin';
        } elseif (Auth::guard('user')->check()) {
            return 'user';
        } elseif (Auth::guard('web')->check()) {
            return 'web';
        }

        return null; // No authentication
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

        $user = $this->getAuthUser();
        $guard = $this->getCurrentGuard();
        $userId = $user ? $user->id : null;

        // ADMIN BRANCH: Admin can update any order
        if ($guard === 'admin') {
            $order = Order::find($id);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            // Validate admin-specific fields
            $request->validate([
                'status' => 'sometimes|string|in:pending,payment_pending,unpaid,awaiting_payment,settlement,capture,paid,processing,shipped,delivered,cancelled,expired,deny',
                'notes' => 'nullable|string|max:500',
                'tracking_number' => 'nullable|string|max:100',
                'estimated_delivery' => 'nullable|date',
            ]);

            // Use transaction for updates
            return DB::transaction(function () use ($request, $order, $user) {
                $changes = [];

                // Handle status changes (Admin specific)
                if ($request->has('status')) {
                    $oldStatus = $order->status;
                    $newStatus = $request->status;

                    // Prevent invalid status transitions
                    $validTransitions = [
                    // Pre-payment / payment states
                    'pending' => [
                        'processing',
                        'shipped',
                        'delivered',
                        'cancelled',
                        'expired',
                    ],

                    'payment_pending' => [
                        'shipped',
                        'delivered',
                        'cancelled',
                        'expired',
                    ],

                    'unpaid' => [
                        'shipped',
                        'delivered',
                        'cancelled',
                        'expired',
                    ],

                    'awaiting_payment' => [
                        'shipped',
                        'delivered',
                        'cancelled',
                        'expired',
                    ],

                    'capture' => [
                        'processing',
                        'shipped',
                        'delivered',
                        'cancelled',
                        'expired',
                    ],

                    // Paid / fulfillment flow
                    'paid' => [
                        'processing',
                        'shipped',
                        'delivered',
                        'cancelled', // manual override
                    ],

                    'settlement' => [
                        'processing',
                        'shipped',
                        'delivered',
                        'cancelled',
                    ],

                    'processing' => [
                        'shipped',
                        'delivered',
                        'cancelled',
                    ],

                    'shipped' => [
                        'delivered',
                        'cancelled', // customer return / admin override
                    ],

                    'delivered' => [
                        'cancelled', // post-delivery dispute
                    ],
                ];

                    // Check if transition is valid
                    if (isset($validTransitions[$oldStatus]) &&
                        !in_array($newStatus, $validTransitions[$oldStatus])) {
                        return response()->json([
                            'success' => false,
                            'message' => "Cannot change status from '{$oldStatus}' to '{$newStatus}'"
                        ], 400);
                    }

                    // Handle stock management for status changes
                    if (in_array($oldStatus, ['pending', 'payment_pending', 'unpaid', 'awaiting_payment']) &&
                        in_array($newStatus, ['cancelled', 'expired'])) {
                        // Restore stock when order is cancelled
                        $product = Product::where('id', $order->id_produk)
                            ->lockForUpdate()
                            ->first();

                        if ($product) {
                            $product->kuantitas += $order->kuantitas;
                            $product->save();
                        }
                    }

                    // Update order status
                    $order->status = $newStatus;
                    $changes['status'] = ['old' => $oldStatus, 'new' => $newStatus];

                    // Add admin note if provided
                    if ($request->has('notes')) {
                        $order->notes = $request->notes;
                        $changes['notes'] = ['old' => $order->getOriginal('notes'), 'new' => $request->notes];
                    }

                    // Add tracking info for shipped orders
                    if ($newStatus === 'shipped' && $request->has('tracking_number')) {
                        $order->tracking_number = $request->tracking_number;
                        $changes['tracking_number'] = ['old' => $order->getOriginal('tracking_number'), 'new' => $request->tracking_number];
                    }

                    // Add estimated delivery
                    if ($request->has('estimated_delivery')) {
                        $order->estimated_delivery = $request->estimated_delivery;
                        $changes['estimated_delivery'] = ['old' => $order->getOriginal('estimated_delivery'), 'new' => $request->estimated_delivery];
                    }

                    // Log admin action
                    if (!empty($changes)) {
                        Log::info('Admin updated order', [
                            'admin_id' => $user->id,
                            'admin_name' => $user->nama,
                            'order_id' => $order->id,
                            'changes' => $changes,
                            'ip_address' => $request->ip()
                        ]);
                    }
                }

                $order->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Order updated successfully',
                    'data' => $order->load(['product', 'address', 'user', 'payment'])
                ]);
            });
        }

        // USER BRANCH: Original user logic (keep your existing code)
        else {
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

                    // Define final statuses
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

    public function invoiceApi(Order $order, Request $request)
    {
        $isAdmin = auth('admin')->check();
        $isUser  = auth('user')->check();

        if (!$isAdmin && !$isUser) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        // User can only see their own order
        if ($isUser && $order->id_pemesan !== auth('user')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $order->load(['user', 'payment', 'product', 'address']);

        return response()->json([
            'success' => true,
            'actor' => $isAdmin ? 'admin' : 'user',
            'data' => [
                'invoice_number' => 'INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                'created_at' => $order->created_at,

                'order' => [
                    'id' => $order->id,
                    'status' => $order->status,
                    'payment_method' => $order->payment_method
                ],

                'customer' => [
                    'nama' => $order->user->nama,
                    'email' => $order->user->email,
                    'telepon' => $order->telepon_penerima,
                    'alamat' => $order->alamat_pengiriman
                        ?? optional($order->address)->alamat
                ],

                'item' => [
                    'nama_produk' => $order->nama_produk
                        ?? optional($order->product)->nama,
                    'harga_produk' => (float) $order->harga_produk,
                    'kuantitas' => $order->kuantitas,
                    'subtotal' => (float) $order->original_total,
                    'potongan_harga' => (float) $order->discount_amount,
                    'total_harga' => (float) $order->total_harga,
                ],

                'payment' => $order->payment ? [
                    'status' => $order->payment->status,
                    'method' => $order->payment->payment_method,
                    'settlement_time' => $order->payment->settlement_time,
                    'transaction_id' => $order->payment->transaction_id
                ] : null
            ]
        ]);
    }
}
