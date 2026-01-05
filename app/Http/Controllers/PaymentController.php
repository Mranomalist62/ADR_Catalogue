<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private function getCurrentGuard()
    {
        if (Auth::guard('admin')->check()) {
            return 'admin';
        } elseif (Auth::guard('user')->check()) {
            return 'user';
        } else {
            return 'web'; // fallback
        }
    }

    /**
     * Get current authenticated user ID based on guard
     */
    private function getCurrentUserId()
    {
        $guard = $this->getCurrentGuard();

        if ($guard === 'admin') {
            return Auth::guard('admin')->id();
        } elseif ($guard === 'user') {
            return Auth::guard('user')->id();
        }

        return Auth::id(); // fallback
    }

    /**
     * Authorize access to order based on guard
     */
    private function authorizeOrderAccess(Order $order)
    {
        $guard = $this->getCurrentGuard();

        if ($guard === 'admin') {
            // Admin can access all orders - no restriction
            return true;
        } elseif ($guard === 'user') {
            // User can only access their own orders
            $userId = $this->getCurrentUserId();
            if ($order->id_pemesan != $userId) {
                abort(403, 'Unauthorized access to this order');
            }
            return true;
        }

        // Default deny if not authenticated via proper guard
        abort(401, 'Unauthenticated');
    }

    /**
     * Get payment details for an order
     * GET /api/payments/order/{orderId}
     */
    public function show($orderId)
    {
        try {
            // FIXED: Changed orderItems to product
            $order = Order::with(['product', 'user', 'address'])
                         ->findOrFail($orderId);

            // Check authorization based on guard
            $this->authorizeOrderAccess($order);

            // FIXED: Changed order_id to id_order
            $payment = Payment::where('id_order', $orderId)->first();

            // Add permission flag in response
            $guard = $this->getCurrentGuard();
            $canModify = ($guard === 'admin');

            return response()->json([
                'success' => true,
                'data' => [
                    'order' => $order,
                    'payment' => $payment,
                    'permissions' => [
                        'can_modify' => $canModify,
                        'guard_type' => $guard
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            if ($statusCode < 100 || $statusCode >= 600) {
                $statusCode = 500;
            }

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => env('APP_DEBUG') ? $e->getTraceAsString() : null
            ], $statusCode);
        }
    }

    /**
     * Initialize Midtrans payment for an order
     * POST /api/payments/create
     */
     public function create(Request $request)
    {
        $guard = $this->getCurrentGuard();

        // Log the incoming request
        Log::info('Payment create request received', [
            'guard' => $guard,
            'order_id' => $request->order_id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        // Only users can create payments, not admins
        if ($guard !== 'user') {
            Log::warning('Non-user trying to create payment', ['guard' => $guard]);
            return response()->json([
                'success' => false,
                'message' => 'Only users can initiate payments'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:order,id'
        ]);

        if ($validator->fails()) {
            Log::warning('Payment validation failed', ['errors' => $validator->errors()->all()]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $orderId = $request->order_id;
        $order = Order::with(['product', 'address'])->find($orderId);

        if (!$order) {
            Log::error('Order not found for payment', ['order_id' => $orderId]);
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        // Check if user owns this order
        $userId = $this->getCurrentUserId();
        if ($order->id_pemesan != $userId) {
            Log::warning('User trying to pay for another user\'s order', [
                'user_id' => $userId,
                'order_user_id' => $order->id_pemesan
            ]);
            return response()->json([
                'success' => false,
                'message' => 'You can only pay for your own orders'
            ], 403);
        }

        // Check if payment already exists
        $existingPayment = Payment::where('id_order', $orderId)->first();
        if ($existingPayment) {
            // If payment already exists and is pending, return existing token
            if ($existingPayment->status === 'pending' && $existingPayment->snap_token) {
                Log::info('Returning existing pending payment', [
                    'order_id' => $orderId,
                    'payment_id' => $existingPayment->id
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Existing payment found',
                    'data' => [
                        'snap_token' => $existingPayment->snap_token,
                        'midtrans_order_id' => $existingPayment->transaction_id,
                        'payment_id' => $existingPayment->id,
                        'client_key' => config('services.midtrans.client_key'),
                    ]
                ]);
            }

            // If payment exists but not pending, check if we can create new one
            if (in_array($existingPayment->status, ['settlement', 'capture', 'success'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order has already been paid'
                ], 400);
            }
        }

        // Validate order can be paid (check order status, not payment status)
        if (in_array($order->status, ['paid', 'completed', 'shipped', 'delivered'])) {
            Log::info('Order already completed', ['order_id' => $orderId, 'status' => $order->status]);
            return response()->json([
                'success' => false,
                'message' => 'Order has already been completed'
            ], 400);
        }

        // Generate unique order ID for Midtrans
        $midtransOrderId = 'PLMB-' . $orderId . '-' . time();

        try {
            Log::info('Calling Midtrans Snap API', [
                'order_id' => $orderId,
                'midtrans_order_id' => $midtransOrderId,
                'amount' => $order->total_harga
            ]);

            // Call Midtrans Snap API
            $snapToken = $this->createSnapTransaction($order, $midtransOrderId);

            Log::info('Midtrans Snap token received', [
                'order_id' => $orderId,
                'token_length' => strlen($snapToken),
                'token_preview' => substr($snapToken, 0, 20) . '...'
            ]);

            // CRITICAL FIX: Create or update payment record
            // The error was because 'id_order' might be a foreign key that doesn't auto-increment
            if ($existingPayment) {
                // Update existing payment
                $existingPayment->update([
                    'payment_method' => 'midtrans',
                    'amount' => $order->total_harga,
                    'status' => 'pending',
                    'transaction_id' => $midtransOrderId,
                    'snap_token' => $snapToken,
                    'payment_date' => null,
                ]);
                $payment = $existingPayment;
            } else {
                // Create new payment - MAKE SURE id_order is included
                $payment = Payment::create([
                    'id_order' => $orderId, // This is essential!
                    'payment_method' => 'midtrans',
                    'amount' => $order->total_harga,
                    'status' => 'pending',
                    'transaction_id' => $midtransOrderId,
                    'snap_token' => $snapToken,
                    'payment_date' => null,
                ]);
            }

            // Update order with Midtrans order ID
            $order->update([
                'midtrans_order_id' => $midtransOrderId,
                'status' => 'payment pending' // Or keep as 'pending' if you prefer
            ]);

            Log::info('Payment record created/updated', [
                'payment_id' => $payment->id,
                'order_id' => $orderId,
                'action' => $existingPayment ? 'updated' : 'created'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment initialized successfully',
                'data' => [
                    'snap_token' => $snapToken,
                    'midtrans_order_id' => $midtransOrderId,
                    'payment_id' => $payment->id,
                    'client_key' => config('services.midtrans.client_key'),
                    'debug' => [
                        'order_total' => $order->total_harga,
                        'order_status' => $order->status,
                        'product_name' => $order->nama_produk
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans payment initialization failed', [
                'order_id' => $orderId,
                'user_id' => $userId,
                'guard' => $guard,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'midtrans_order_id' => $midtransOrderId ?? 'not_generated'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment gateway error',
                'error' => env('APP_DEBUG') ? $e->getMessage() : 'Internal server error',
                'debug' => env('APP_DEBUG') ? [
                    'exception' => get_class($e),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ] : null
            ], 500);
        }
    }

    /**
     * Payment return callback (when user finishes payment)
     * GET /api/payments/return/{orderId}
     */
    public function paymentReturn($orderId)
    {
        try {
            $order = Order::find($orderId);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            // Check authorization based on guard
            $this->authorizeOrderAccess($order);

            // Get latest payment status
            $payment = Payment::where('id_order', $orderId)->latest()->first();

            $guard = $this->getCurrentGuard();
            $canModify = ($guard === 'admin');

            if ($payment && in_array($payment->status, ['settlement', 'capture'])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful',
                    'data' => [
                        'order' => $order,
                        'payment' => $payment,
                        'status' => 'success',
                        'permissions' => [
                            'can_modify' => $canModify,
                            'guard_type' => $guard
                        ]
                    ]
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment is being processed',
                'data' => [
                    'order' => $order,
                    'payment' => $payment,
                    'status' => 'pending',
                    'permissions' => [
                        'can_modify' => $canModify,
                        'guard_type' => $guard
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            if ($statusCode < 100 || $statusCode >= 600) {
                $statusCode = 500;
            }

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => env('APP_DEBUG') ? $e->getTraceAsString() : null
            ], $statusCode);
        }
    }

    /**
     * Payment error callback
     * GET /api/payments/error/{orderId}
     */
    public function paymentError($orderId)
    {
        try {
            $order = Order::find($orderId);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            // Check authorization based on guard
            $this->authorizeOrderAccess($order);

            $payment = Payment::where('id_order', $orderId)->latest()->first();

            $guard = $this->getCurrentGuard();
            $canModify = ($guard === 'admin');

            return response()->json([
                'success' => false,
                'message' => 'Payment failed or was cancelled',
                'data' => [
                    'order' => $order,
                    'payment' => $payment,
                    'status' => 'error',
                    'permissions' => [
                        'can_modify' => $canModify,
                        'guard_type' => $guard
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            if ($statusCode < 100 || $statusCode >= 600) {
                $statusCode = 500;
            }

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => env('APP_DEBUG') ? $e->getTraceAsString() : null
            ], $statusCode);
        }
    }

    /**
     * Payment pending callback
     * GET /api/payments/pending/{orderId}
     */
    public function paymentPending($orderId)
    {
        try {
            $order = Order::find($orderId);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            // Check authorization based on guard
            $this->authorizeOrderAccess($order);

            $payment = Payment::where('id_order', $orderId)->latest()->first();

            $guard = $this->getCurrentGuard();
            $canModify = ($guard === 'admin');

            return response()->json([
                'success' => true,
                'message' => 'Payment is pending. We will notify you once it\'s completed.',
                'data' => [
                    'order' => $order,
                    'payment' => $payment,
                    'status' => 'pending',
                    'permissions' => [
                        'can_modify' => $canModify,
                        'guard_type' => $guard
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            if ($statusCode < 100 || $statusCode >= 600) {
                $statusCode = 500;
            }

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => env('APP_DEBUG') ? $e->getTraceAsString() : null
            ], $statusCode);
        }
    }

    /**
     * Handle Midtrans webhook notification (NO GUARD CHECK - This is called by Midtrans)
     * POST /api/payments/notification
     */
    public function handleNotification(Request $request)
    {
        Log::info('Midtrans notification received', [
            'payload' => $request->all(),
            'ip' => $request->ip()
        ]);

        try {
            // Verify the notification is from Midtrans (optional: verify signature)
            $notification = $request->all();

            // Get transaction details
            $orderId = $notification['order_id'] ?? null;
            $transactionStatus = $notification['transaction_status'] ?? null;
            $fraudStatus = $notification['fraud_status'] ?? null;
            $paymentType = $notification['payment_type'] ?? null;

            if (!$orderId || !$transactionStatus) {
                Log::error('Invalid notification payload', ['notification' => $notification]);
                return response()->json(['status' => 'error', 'message' => 'Invalid payload'], 400);
            }

            // Find payment by transaction_id (Midtrans order_id)
            $payment = Payment::where('transaction_id', $orderId)->first();

            if (!$payment) {
                Log::error('Payment not found for notification', ['order_id' => $orderId]);
                return response()->json(['status' => 'error', 'message' => 'Payment not found'], 404);
            }

            // Update payment status
            $oldStatus = $payment->status;
            $payment->update([
                'status' => $transactionStatus,
                'payment_method' => $paymentType,
                'raw_response' => json_encode($notification),
                'payment_date' => in_array($transactionStatus, ['settlement', 'capture']) ? now() : null,
            ]);

            // Update order status based on payment
            $order = Order::find($payment->id_order);
            if ($order) {
                $orderStatus = $this->mapPaymentToOrderStatus($transactionStatus, $fraudStatus);
                $oldOrderStatus = $order->status;
                $order->update(['status' => $orderStatus]);

                Log::info('Order status updated', [
                    'order_id' => $order->id,
                    'old_status' => $oldOrderStatus,
                    'new_status' => $orderStatus,
                    'payment_status' => $transactionStatus
                ]);
            }

            Log::info('Notification processed successfully', [
                'payment_id' => $payment->id,
                'old_status' => $oldStatus,
                'new_status' => $transactionStatus,
                'order_id' => $order->id ?? null
            ]);

            return response()->json(['status' => 'ok']);

        } catch (\Exception $e) {
            Log::error('Error processing Midtrans notification', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all()
            ]);

            return response()->json(['status' => 'error', 'message' => 'Processing failed'], 500);
        }
    }

    /**
     * Map Midtrans payment status to order status
     */
    private function mapPaymentToOrderStatus($paymentStatus, $fraudStatus = null)
    {
        $statusMap = [
            'capture' => 'paid',
            'settlement' => 'paid',
            'pending' => 'payment pending',
            'deny' => 'payment failed',
            'expire' => 'payment expired',
            'cancel' => 'cancelled',
        ];

        $orderStatus = $statusMap[$paymentStatus] ?? 'pending';

        // Handle fraud cases
        if ($fraudStatus === 'challenge') {
            return 'payment_challenge';
        } elseif ($fraudStatus === 'deny') {
            return 'payment_failed';
        }

        return $orderStatus;
    }

    /**
     * Get user payment history
     * GET /api/payments/history
     */
    public function history(Request $request)
    {
        $guard = $this->getCurrentGuard();
        $perPage = $request->get('per_page', 10);
        $status = $request->get('status');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $userId = $request->get('user_id');

        if ($guard === 'admin') {
            // Admin can see all payments or filter by specific user
            // FIXED: Changed order.orderItems.product to order.product
            $query = Payment::with(['order.product', 'order.user']);

            if ($userId) {
                $query->whereHas('order', function($q) use ($userId) {
                    $q->where('id_pemesan', $userId);
                });
            }

        } elseif ($guard === 'user') {
            // User can only see their own payments
            $userId = $this->getCurrentUserId();
            $query = Payment::whereHas('order', function($q) use ($userId) {
                    $q->where('id_pemesan', $userId);
                })
                ->with(['order.product']); // FIXED: Changed orderItems.product to product
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Apply filters
        if ($status) {
            $query->where('status', $status);
        }

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $payments,
            'meta' => [
                'total' => $payments->total(),
                'per_page' => $payments->perPage(),
                'current_page' => $payments->currentPage(),
                'last_page' => $payments->lastPage(),
                'guard_type' => $guard,
                'is_admin' => ($guard === 'admin')
            ]
        ]);
    }

    /**
     * Get payment details by ID
     * GET /api/payments/{paymentId}
     */
    public function detail($paymentId)
    {
        // FIXED: Changed order.orderItems.product to order.product
        $payment = Payment::with(['order.product', 'order.user', 'order.address'])
                         ->find($paymentId);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        // Check authorization based on guard
        try {
            $this->authorizeOrderAccess($payment->order);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 403);
        }

        $guard = $this->getCurrentGuard();

        return response()->json([
            'success' => true,
            'data' => $payment,
            'permissions' => [
                'can_modify' => ($guard === 'admin'),
                'guard_type' => $guard
            ]
        ]);
    }

    /**
     * Check payment status manually
     * GET /api/payments/status/{orderId}
     */
    public function checkStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        // Check authorization
        try {
            $this->authorizeOrderAccess($order);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 403);
        }

        // FIXED: Changed order_id to id_order
        $payment = Payment::where('id_order', $orderId)->first();

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'No payment found for this order'
            ], 404);
        }

        try {
            // Check status via Midtrans API if transaction_id exists
            $midtransStatus = null;
            if ($payment->transaction_id) {
                $midtransStatus = $this->checkMidtransStatus($payment->transaction_id);

                // Update local status if different
                if ($midtransStatus && isset($midtransStatus['transaction_status'])) {
                    if ($payment->status != $midtransStatus['transaction_status']) {
                        $payment->update([
                            'status' => $midtransStatus['transaction_status'],
                            'raw_response' => $midtransStatus
                        ]);
                    }
                }
            }

            $guard = $this->getCurrentGuard();

            return response()->json([
                'success' => true,
                'data' => [
                    'payment' => $payment,
                    'midtrans_status' => $midtransStatus,
                    'is_final' => $this->isFinalStatus($payment->status),
                    'permissions' => [
                        'can_modify' => ($guard === 'admin')
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error checking payment status',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Cancel a pending payment
     * POST /api/payments/{orderId}/cancel
     */
    public function cancel(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $guard = $this->getCurrentGuard();

        if ($guard === 'user') {
            // User can only cancel their own orders
            $userId = $this->getCurrentUserId();
            if ($order->id_pemesan != $userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only cancel your own orders'
                ], 403);
            }
        } elseif ($guard !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // FIXED: Changed order_id to id_order
        $payment = Payment::where('id_order', $orderId)->first();

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'No payment found for this order'
            ], 404);
        }

        if ($payment->status == 'pending') {
            $payment->update(['status' => 'cancelled']);
            $order->update(['status' => 'cancelled']);

            return response()->json([
                'success' => true,
                'message' => 'Payment cancelled successfully',
                'data' => $payment
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Cannot cancel payment with status: ' . $payment->status
        ], 400);
    }

    /**
     * Admin-only: Update payment status
     * PUT /api/payments/{paymentId}/status
     */
    public function updateStatus(Request $request, $paymentId)
    {
        // Only admin can update payment status
        if ($this->getCurrentGuard() !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Only administrators can update payment status'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,success,settlement,capture,failed,cancelled,expired',
            'notes' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $payment = Payment::find($paymentId);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $oldStatus = $payment->status;
        $payment->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        // Log admin action
        Log::info('Admin updated payment status', [
            'payment_id' => $paymentId,
            'admin_id' => $this->getCurrentUserId(),
            'old_status' => $oldStatus,
            'new_status' => $request->status,
            'notes' => $request->notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment status updated successfully',
            'data' => $payment
        ]);
    }

    public function paymentUnfinished($orderId)
    {
        try {
            $order = Order::find($orderId);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            // Check authorization
            $this->authorizeOrderAccess($order);

            $payment = Payment::where('id_order', $orderId)->latest()->first();
            $guard = $this->getCurrentGuard();
            $canModify = ($guard === 'admin');

            // DON'T update status - just return info
            return response()->json([
                'success' => true,
                'message' => 'Payment window closed',
                'data' => [
                    'order' => $order,
                    'payment' => $payment,
                    'status' => 'unfinished', // Special status
                    'action_required' => true, // Frontend can show "Continue Payment" button
                    'permissions' => [
                        'can_modify' => $canModify,
                        'guard_type' => $guard
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    /**
     * Check if status is final (won't change)
     */
    private function isFinalStatus($status)
    {
        $finalStatuses = ['settlement', 'capture', 'success', 'deny', 'expire', 'cancel'];
        return in_array($status, $finalStatuses);
    }
    private function createSnapTransaction(Order $order, $midtransOrderId)
    {
        $serverKey = config('services.midtrans.server_key');
        $clientKey = config('services.midtrans.client_key');
        $isProduction = config('services.midtrans.is_production', false);

        Log::info('Creating Snap transaction', [
            'midtrans_order_id' => $midtransOrderId,
            'order_total_harga' => $order->total_harga,
            'order_harga_produk' => $order->harga_produk,
            'order_kuantitas' => $order->kuantitas,
            'order_potongan_harga' => $order->potongan_harga,
        ]);

        if (empty($serverKey)) {
            throw new \Exception('Midtrans server key is not configured');
        }

        $baseUrl = $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        // CRITICAL FIX: Calculate item price AFTER discount
        $hargaProduk = (int) $order->harga_produk; // Original price: 150,000
        $potonganPersen = (float) $order->potongan_harga; // Discount percentage: 20%

        // Calculate price per item after discount
        $hargaSetelahDiskon = $hargaProduk;
        if ($potonganPersen > 0) {
            $hargaSetelahDiskon = $hargaProduk - ($hargaProduk * $potonganPersen / 100);
        }

        // Round to integer (Midtrans requires integer)
        $hargaSetelahDiskon = (int) round($hargaSetelahDiskon); // Should be 120,000

        // Verify calculation matches order total
        $calculatedTotal = $hargaSetelahDiskon * (int) $order->kuantitas;
        $orderTotal = (int) $order->total_harga;

        Log::info('Price calculations', [
            'original_price' => $hargaProduk,
            'discount_percentage' => $potonganPersen,
            'price_after_discount' => $hargaSetelahDiskon,
            'quantity' => (int) $order->kuantitas,
            'calculated_total' => $calculatedTotal,
            'order_total' => $orderTotal,
            'match' => $calculatedTotal === $orderTotal
        ]);

        // Use order total directly to avoid rounding issues
        $grossAmount = $orderTotal; // 120,000

        // Prepare transaction details
        $transactionDetails = [
            'order_id' => $midtransOrderId,
            'gross_amount' => $grossAmount,
        ];

        // Prepare item details - SIMPLIFIED: Just one item with discounted price
        $itemDetails = [[
            'id' => $order->id_produk ?? 'product-' . $order->id,
            'price' => $hargaSetelahDiskon, // Use discounted price: 120,000
            'quantity' => (int) $order->kuantitas, // 1
            'name' => $order->nama_produk ?? 'Produk',
        ]];

        // Prepare customer details
        $customerName = $order->nama_penerima ?? ($order->user->nama ?? 'Customer');
        $customerEmail = $order->user->email ?? 'customer@example.com';
        $customerPhone = $order->telepon_penerima ?? ($order->user->telepon ?? '');

        $customerDetails = [
            'first_name' => $customerName,
            'email' => $customerEmail,
            'phone' => $customerPhone,
        ];


        $payload = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
            'callbacks' => [
                 'finish' => url("/user/api/payments/return/{$order->id}"),
                'error' => url("/user/api/payments/error/{$order->id}"),
                'pending' => url("/user/api/payments/pending/{$order->id}"),
                'close' => url("/user/api/payments/unfinished/{$order->id}"),
            ],

            'enabled_payments' => [
                'credit_card',
                'bca_va',
                'bni_va',
                'bri_va',
                'permata_va',
                'other_va',
                'gopay', // Enables GoPay and its QRIS
            ],
            'credit_card' => [
                'secure' => true,

            ],
            'expiry' => [
                'start_time' => date("Y-m-d H:i:s O", time()),
                'unit' => 'minutes',
                'duration' => 1440 // Payment expires in 24 hours
            ],
];

        // Verify item sum equals gross amount
        $itemSum = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $itemDetails));

        Log::info('Payload verification', [
            'gross_amount' => $grossAmount,
            'item_sum' => $itemSum,
            'match' => $grossAmount === $itemSum,
            'item_details' => $itemDetails
        ]);

        if ($grossAmount !== $itemSum) {
            Log::error('Item sum mismatch', [
                'gross_amount' => $grossAmount,
                'item_sum' => $itemSum,
                'difference' => $grossAmount - $itemSum
            ]);

            // FIX: If there's a mismatch due to rounding, adjust the price
            if (abs($grossAmount - $itemSum) <= 1) {
                $itemDetails[0]['price'] = $grossAmount; // Use exact total as price
                Log::info('Adjusted for rounding difference', [
                    'new_price' => $itemDetails[0]['price']
                ]);
            } else {
                throw new \Exception('Item total does not match gross amount. Gross: ' . $grossAmount . ', Items: ' . $itemSum);
            }
        }

        Log::info('Midtrans payload prepared', [
            'payload' => $payload,
            'payload_size' => strlen(json_encode($payload))
        ]);

        // Send request to Midtrans
        try {
            $httpClient = Http::withOptions([
                'verify' => false, // Disable SSL verification
                'timeout' => 30,
                'connect_timeout' => 10,
            ])->withBasicAuth($serverKey, '')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]);

            $response = $httpClient->post($baseUrl, $payload);

            Log::info('Midtrans API response', [
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            if (!$response->successful()) {
                $error = $response->json();
                Log::error('Midtrans API error response', [
                    'error_message' => $error['error_message'] ?? 'Unknown error',
                    'error_code' => $error['status_code'] ?? 'No code',
                    'full_response' => $error
                ]);
                throw new \Exception('Midtrans API error: ' . ($error['error_message'] ?? $response->body()));
            }

            $data = $response->json();

            if (!isset($data['token'])) {
                Log::error('Midtrans response missing token', ['response' => $data]);
                throw new \Exception('Midtrans response missing token');
            }

            Log::info('Midtrans token generated successfully');
            return $data['token'];

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Midtrans connection failed', [
                'error' => $e->getMessage(),
                'url' => $baseUrl
            ]);
            throw new \Exception('Cannot connect to Midtrans server. Check your internet connection.');
        } catch (\Exception $e) {
            Log::error('Midtrans API call failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    // Also fix the checkMidtransStatus method if it exists but isn't shown:
    private function checkMidtransStatus($transactionId)
    {
        $serverKey = config('services.midtrans.server_key');
        $isProduction = config('services.midtrans.is_production', false);

        $baseUrl = $isProduction
            ? "https://api.midtrans.com/v2/{$transactionId}/status"
            : "https://api.sandbox.midtrans.com/v2/{$transactionId}/status";

        try {
            $response = Http::withOptions([
                'verify' => false, // Disable SSL verification
                'timeout' => 30,
                'connect_timeout' => 10,
            ])->withBasicAuth($serverKey, '')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->get($baseUrl);

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Error checking Midtrans status', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
}
