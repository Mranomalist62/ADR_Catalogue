<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    public function handleNotification(Request $request)
    {
        // 1. Verify the signature (IMPORTANT for security)
        $signatureKey = hash('sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            env('MIDTRANS_SERVER_KEY')
        );

        if ($signatureKey != $request->signature_key) {
            Log::warning('Invalid signature from Midtrans', ['order_id' => $request->order_id]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // 2. Find the order
        $order = Order::where('order_number', $request->order_id)->first();

        if (!$order) {
            Log::error('Order not found for Midtrans notification', ['order_id' => $request->order_id]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 3. Normalize payment data based on payment type
        $paymentData = $this->normalizePaymentData($request);

        // 4. Create or update payment record
        $payment = Payment::updateOrCreate(
            ['order_id' => $order->id],
            $paymentData
        );

        // 5. Update order status based on payment status
        $this->updateOrderStatus($order, $request->transaction_status);

        Log::info('Midtrans webhook processed', [
            'order_id' => $order->id,
            'payment_id' => $payment->id,
            'status' => $request->transaction_status
        ]);

        return response()->json(['message' => 'Notification processed'], 200);
    }

    private function normalizePaymentData(Request $request): array
    {
        // Base data common to all payment types
        $baseData = [
            'order_id' => $this->findOrderIdByMidtransOrderId($request->order_id),
            'payment_method' => $request->payment_type,
            'amount' => $request->gross_amount,
            'status' => $request->transaction_status,
            'transaction_id' => $request->transaction_id,
            'raw_response' => json_encode($request->all()),
            'payment_date' => $request->transaction_time ?
                \Carbon\Carbon::parse($request->transaction_time) : now(),
        ];

        // Payment type specific data extraction
        switch ($request->payment_type) {
            case 'credit_card':
                $baseData['bank'] = $request->bank;
                $baseData['masked_card'] = $request->masked_card;
                $baseData['fraud_status'] = $request->fraud_status;
                break;

            case 'qris':
                $baseData['bank'] = $request->issuer ?? $request->acquirer;
                $baseData['settlement_time'] = $request->settlement_time ?
                    \Carbon\Carbon::parse($request->settlement_time) : null;
                break;

            case 'bank_transfer':
                if (isset($request->va_numbers[0])) {
                    $baseData['bank'] = $request->va_numbers[0]['bank'];
                    $baseData['va_number'] = $request->va_numbers[0]['va_number'];
                }
                $baseData['settlement_time'] = $request->settlement_time ?
                    \Carbon\Carbon::parse($request->settlement_time) : null;
                break;

            // Add more payment types as needed
        }

        // For settlement status, update payment date to settlement time
        if ($request->transaction_status === 'settlement' && isset($request->settlement_time)) {
            $baseData['payment_date'] = \Carbon\Carbon::parse($request->settlement_time);
        }

        return $baseData;
    }

    private function updateOrderStatus(Order $order, string $transactionStatus): void
    {
        $statusMap = [
            'capture' => 'paid',
            'settlement' => 'paid',
            'pending' => 'pending',
            'deny' => 'failed',
            'expire' => 'expired',
            'cancel' => 'cancelled',
        ];

        if (isset($statusMap[$transactionStatus])) {
            $order->status = $statusMap[$transactionStatus];
            $order->save();
        }
    }

    private function findOrderIdByMidtransOrderId(string $midtransOrderId)
    {
        // Implement logic to find your internal order ID
        // This might involve parsing the Midtrans order ID
        // or maintaining a mapping table
        $order = Order::where('order_number', $midtransOrderId)->first();
        return $order ? $order->id : null;
    }
}
