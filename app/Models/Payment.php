<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = ['id_order', 'bukti_pembayaran', 'nominal'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }
}
