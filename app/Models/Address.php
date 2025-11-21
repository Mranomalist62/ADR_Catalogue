<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = ['nama', 'desk_alamat', 'id_user', 'selected'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
