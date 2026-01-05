<?php
// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['nama', 'kuantitas', 'id_kategori', 'harga_satuan', 'path_thumbnail', 'desc'];
    // REMOVE 'id_promo' - it doesn't exist anymore!

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }

    // One product HAS ONE promo (via promo.product_id)
    public function promo()
    {
        return $this->hasOne(Promo::class, 'product_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_produk');
    }
}
