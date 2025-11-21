<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';
    protected $fillable = ['nama', 'potongan_harga', 'path_thumbnail'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'promolist', 'id_promo', 'id_produk');
    }
}
