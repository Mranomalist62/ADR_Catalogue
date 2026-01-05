<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = ['nama', 'desk_alamat', 'id_user', 'selected'];

    protected $casts = [
        'selected' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Helper: Get user's default address
    public static function getDefaultAddress($userId)
    {
        return self::where('id_user', $userId)
                   ->where('selected', true)
                   ->first();
    }

    // Helper: Mark as default
    public function markAsDefault()
    {
        self::where('id_user', $this->id_user)->update(['selected' => false]);

        // Then select this one
        $this->selected = true;
        $this->save();
    }
}
