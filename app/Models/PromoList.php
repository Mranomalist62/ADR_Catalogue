<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoList extends Model
{
    protected $table = 'promolist';
    protected $fillable = ['id_produk', 'id_promo', 'path_thumbnail'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id_promo');
    }
}
