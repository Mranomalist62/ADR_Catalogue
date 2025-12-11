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
        'id_promo', //to be deleted
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
     * Get the promo for the order.
     */
    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
