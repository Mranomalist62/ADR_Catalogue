<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'id_order',
        'payment_method',
        'amount',
        'status',
        'payment_date',
        'proof_of_payment',
        // Add these for Midtrans integration
        'transaction_id',
        'raw_response',
        'bank',
        'masked_card',
        'va_number',
        'settlement_time',
        'fraud_status'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'settlement_time' => 'datetime',
        'raw_response' => 'array' // Automatically cast JSON to array
    ];

    /**
     * Get the order that owns the payment.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Scope queries to find payments by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope queries to find payments by Midtrans transaction ID
     */
    public function scopeByTransactionId($query, $transactionId)
    {
        return $query->where('transaction_id', $transactionId);
    }
}
