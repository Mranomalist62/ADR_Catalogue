<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';
    protected $fillable = ['nama', 'potongan_harga', 'path_thumbnail'];

    // One promo belongs to exactly one product
    public function product()
    {
        return $this->hasOne(Product::class, 'id_promo');
    }
}
