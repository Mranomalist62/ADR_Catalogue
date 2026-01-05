<?php
// app/Models/Promo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';
    protected $fillable = ['nama', 'potongan_harga', 'path_thumbnail', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
