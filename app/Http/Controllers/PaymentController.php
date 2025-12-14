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
    /**
     * Get current authenticated guard (user or admin)
     */
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
            $order = Order::with(['orderItems.product', 'user', 'address'])
                         ->findOrFail($orderId);

            // Check authorization based on guard
            $this->authorizeOrderAccess($order);

            $payment = Payment::where('order_id', $orderId)->first();

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

        // Only users can create payments, not admins
        if ($guard !== 'user') {
            return response()->json([
                'success' => false,
                'message' => 'Only users can initiate payments'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $orderId = $request->order_id;
        $order = Order::with('orderItems.product')->find($orderId);

        // Check if user owns this order
        $userId = $this->getCurrentUserId();
        if ($order->id_pemesan != $userId) {
            return response()->json([
                'success' => false,
                'message' => 'You can only pay for your own orders'
            ], 403);
        }

        // Validate order can be paid
        if ($order->status == 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'Order has already been paid'
            ], 400);
        }

        // Generate unique order ID for Midtrans
        $midtransOrderId = 'PLMB-' . $orderId . '-' . time();

        try {
            // Call Midtrans Snap API
            $snapToken = $this->createSnapTransaction($order, $midtransOrderId);

            // Create pending payment record
            $payment = Payment::create([
                'order_id' => $orderId,
                'payment_method' => 'pending',
                'amount' => $order->total_harga,
                'status' => 'pending',
                'transaction_id' => $midtransOrderId,
                'payment_date' => null,
            ]);

            // Update order with Midtrans order ID
            $order->update([
                'midtrans_order_id' => $midtransOrderId,
                'status' => 'payment_pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment initialized successfully',
                'data' => [
                    'snap_token' => $snapToken,
                    'midtrans_order_id' => $midtransOrderId,
                    'payment_id' => $payment->id,
                    'client_key' => config('services.midtrans.client_key'),
                    'redirect_urls' => [
                        'finish' => route('api.payment.return', $order->id),
                        'error' => route('api.payment.error', $order->id),
                        'pending' => route('api.payment.pending', $order->id),
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans payment initialization failed', [
                'order_id' => $orderId,
                'user_id' => $userId,
                'guard' => $guard,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment gateway error',
                'error' => env('APP_DEBUG') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
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
            $query = Payment::with(['order.orderItems.product', 'order.user']);

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
                ->with(['order.orderItems.product']);
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
        $payment = Payment::with(['order.orderItems.product', 'order.user', 'order.address'])
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

        $payment = Payment::where('order_id', $orderId)->first();

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

        $payment = Payment::where('order_id', $orderId)->first();

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

    /**
     * Admin-only: Get payments statistics
     * GET /api/payments/statistics
     */
    public function getStatistics(Request $request)
    {
        // Only admin can view statistics
        if ($this->getCurrentGuard() !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Only administrators can view statistics'
            ], 403);
        }

        $startDate = $request->get('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));

        $statistics = [
            'total_payments' => Payment::whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_amount' => Payment::whereBetween('created_at', [$startDate, $endDate])->sum('amount'),
            'successful_payments' => Payment::whereIn('status', ['settlement', 'capture', 'success'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'pending_payments' => Payment::where('status', 'pending')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'failed_payments' => Payment::whereIn('status', ['failed', 'deny', 'expire'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'payment_methods' => Payment::selectRaw('payment_method, COUNT(*) as count, SUM(amount) as total')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('payment_method')
                ->get(),
            'daily_summary' => Payment::selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(amount) as total')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get()
        ];

        return response()->json([
            'success' => true,
            'data' => $statistics,
            'period' => [
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        ]);
    }

    /**
     * Check if status is final (won't change)
     */
    private function isFinalStatus($status)
    {
        $finalStatuses = ['settlement', 'capture', 'success', 'deny', 'expire', 'cancel'];
        return in_array($status, $finalStatuses);
    }

    /**
     * Create Snap transaction on Midtrans
     */
    private function createSnapTransaction(Order $order, $midtransOrderId)
    {
        // ... (same as before, no changes needed)
        $serverKey = config('services.midtrans.server_key');
        $isProduction = config('services.midtrans.is_production', false);

        $baseUrl = $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        // Prepare transaction details
        $transactionDetails = [
            'order_id' => $midtransOrderId,
            'gross_amount' => (int) $order->total_harga,
        ];

        // ... rest of the method unchanged
        // (keep your existing implementation here)
    }
}
