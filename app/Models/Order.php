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
        'nama_produk',          // Snapshot: product name at time of purchase
        'harga_produk',         // Snapshot: product price at time of purchase
        'nama_promo',           // Snapshot: promo name at time of purchase
        'potongan_harga',       // Snapshot: discount percentage at time
        'kuantitas',
        'total_harga',
        'total_instalment',
        'waktu_berlaku',
        'status',
        'payment_method'
    ];

    protected $casts = [
        'harga_produk' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'potongan_harga' => 'decimal:2',
        'total_instalment' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pemesan');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk')->withTrashed();
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
     * Accessor for price per item after discount
     */
    public function getHargaPerItemAttribute()
    {
        if ($this->potongan_harga > 0) {
            return $this->harga_produk - (($this->potongan_harga / 100) * $this->harga_produk);
        }
        return $this->harga_produk;
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
