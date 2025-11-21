<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $fillable = ['nama', 'password', 'nomor_handphone', 'email'];

    protected $hidden = ['password'];
}
