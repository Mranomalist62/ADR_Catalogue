<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['nama', 'path_thumbnail'];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_kategori');
    }
}
