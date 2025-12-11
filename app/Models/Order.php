<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id_pemesan',
        'id_produk',
        'id_promo',
        'nama_promo',
        'potongan_harga',
        'kuantitas',
        'total_harga',
        'total_instalment',
        'waktu_berlaku',
        'status',
        'payment_method'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the address for the order.
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Get the payment for the order.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the order items for the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the promo for the order.
     */
    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }
}
