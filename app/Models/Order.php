<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'id_pemesan',
        'id_produk',
        'id_alamat',
        'nama_produk',
        'harga_produk',
        'nama_promo',
        'potongan_harga',
        'kuantitas',
        'total_harga',
        'total_instalment',
        'waktu_berlaku',
        'status',
        'payment_method',
        'alamat_pengiriman',
        'nama_penerima',
        'telepon_penerima'
    ];

    protected $casts = [
        'harga_produk' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'potongan_harga' => 'decimal:2',
        'total_instalment' => 'decimal:2',
        'waktu_berlaku' => 'datetime',
    ];

    /**
     * Get the user who made the order
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pemesan');
    }

    /**
     * Get the address for the order
     * FIXED: Specify foreign key 'id_alamat' and local key 'id'
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'id_alamat');
    }

    /**
     * Get the payment for the order
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }

    /**
     * Accessor for original price before discount
     */
    public function getOriginalTotalAttribute()
    {
        return $this->harga_produk * $this->kuantitas;
    }

    /**
     * Accessor for discount amount
     */
    public function getDiscountAmountAttribute()
    {
        if ($this->potongan_harga > 0) {
            return ($this->potongan_harga / 100) * $this->getOriginalTotalAttribute();
        }
        return 0;
    }

    /**
     * Check if order is expired
     */
    public function getIsExpiredAttribute()
    {
        if (!$this->waktu_berlaku) {
            return false;
        }
        return now()->greaterThan($this->waktu_berlaku);
    }

    /**
     * Status with color for display
     */
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'pending' => ['color' => 'bg-yellow-100 text-yellow-800', 'label' => 'Menunggu Pembayaran'],
            'paid' => ['color' => 'bg-blue-100 text-blue-800', 'label' => 'Sudah Dibayar'],
            'processing' => ['color' => 'bg-purple-100 text-purple-800', 'label' => 'Diproses'],
            'shipped' => ['color' => 'bg-indigo-100 text-indigo-800', 'label' => 'Dikirim'],
            'delivered' => ['color' => 'bg-green-100 text-green-800', 'label' => 'Selesai'],
            'cancelled' => ['color' => 'bg-red-100 text-red-800', 'label' => 'Dibatalkan'],
            'expired' => ['color' => 'bg-gray-100 text-gray-800', 'label' => 'Kadaluarsa'],
        ];

        $status = $this->is_expired ? 'expired' : $this->status;

        return $statuses[$status] ?? ['color' => 'bg-gray-100 text-gray-800', 'label' => $this->status];
    }
}
