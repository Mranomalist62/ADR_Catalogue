<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'message',
        'sender',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user that owns the chat.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin that owns the chat.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Mark the chat as read.
     */
    public function markAsRead()
    {
        $this->is_read = true;
        $this->read_at = now();
        $this->save();
    }

    /**
     * Scope a query to only include unread messages.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope a query to only include messages from a specific user.
     */
    public function scopeFromUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get bot response for user message.
     */
    public static function getBotResponse($userMessage)
    {
        $message = strtolower($userMessage);
        
        // Simple bot responses based on keywords
        if (strpos($message, 'harga') !== false || strpos($message, 'price') !== false) {
            return "Untuk informasi harga, Anda dapat melihat halaman produk kami atau menghubungi admin untuk detail lebih lanjut.";
        }
        
        if (strpos($message, 'promo') !== false || strpos($message, 'diskon') !== false) {
            return "Kami memiliki promo menarik! Silakan cek halaman promo untuk melihat penawaran terbaru kami.";
        }
        
        if (strpos($message, 'pengiriman') !== false || strpos($message, 'kirim') !== false) {
            return "Pengiriman biasanya memakan waktu 2-5 hari kerja tergantung lokasi Anda. Info lebih lengkap ada di halaman pengiriman.";
        }
        
        if (strpos($message, 'pengembalian') !== false || strpos($message, 'return') !== false) {
            return "Kebijakan pengembalian kami berlaku 7 hari setelah pembelian. Detail lengkap ada di halaman pengembalian.";
        }
        
        if (strpos($message, 'hello') !== false || strpos($message, 'halo') !== false || strpos($message, 'hai') !== false) {
            return "Halo! Selamat datang di ADR Catalogue. Ada yang bisa saya bantu?";
        }
        
        if (strpos($message, 'terima kasih') !== false || strpos($message, 'thank') !== false) {
            return "Sama-sama! Senang bisa membantu Anda. Ada yang lain bisa saya bantu?";
        }
        
        // Default response
        return "Terima kasih telah menghubungi kami. Admin akan segera membalas pesan Anda. Jika pertanyaan mendesak, silakan hubungi nomor customer service kami.";
    }
}
