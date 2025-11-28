<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['nama', 'kuantitas', 'id_kategori', 'harga_satuan', 'path_thumbnail', 'desc'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'active_promo_id');
    }


    public function orders()
    {
        return $this->hasMany(Order::class, 'id_produk');
    }
}
