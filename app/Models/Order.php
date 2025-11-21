<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'id_pemesan',
        'id_produk',
        'id_promo',
        'kuantitas',
        'total_harga',
        'total_instalment',
        'waktu_berlaku',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pemesan');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id_promo');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id_order');
    }
}
