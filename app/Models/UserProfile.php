<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';
    protected $fillable = ['nomor_handphone', 'path_thumbnail'];

    public function user()
    {
        return $this->hasOne(User::class, 'id_profile');
    }
}
