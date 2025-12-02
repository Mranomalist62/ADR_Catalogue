<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['nama', 'kuantitas', 'id_kategori', 'path_thumbnail', 'desc', 'harga', 'diskon'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'promolist', 'id_produk', 'id_promo');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_produk');
    }
}
