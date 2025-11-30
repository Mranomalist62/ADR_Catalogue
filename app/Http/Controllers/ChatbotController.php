<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function reply(Request $request)
    {
        $message = $request->input('message');
        $apiKey = env('GOOGLE_API_KEY');

        // ================
        // 🕒 JAM OPERASIONAL
        // ================
        $now = now()->setTimezone('Asia/Jakarta');
        $start = now()->setTimezone('Asia/Jakarta')->setTime(8, 0);
        $end = now()->setTimezone('Asia/Jakarta')->setTime(23, 59);

        if ($now->lt($start) || $now->gt($end)) {
            return response()->json([
                'reply' => 'Maaf, layanan chatbot ADRCatalog hanya aktif pukul 08.00–22.00 WIB. Silakan kembali pada jam kerja.'
            ]);
        }

        // ======================
        // 🔥 AMBIL DATA PRODUK
        // ======================
        $products = DB::table('product')
            ->join('category', 'product.id_kategori', '=', 'category.id')
            ->leftJoin('promo', 'product.id_promo', '=', 'promo.id')
            ->select(
                'product.nama',
                'product.kuantitas',
                'product.harga_satuan',
                'category.nama as kategori',
                'promo.nama as promo_nama',
                'promo.potongan_harga'
            )
            ->get();

        if ($products->isEmpty()) {
            $productList = "Tidak ada produk yang tersedia di database.";
        } else {
            $productList = "";
            foreach ($products as $p) {
                $promoInfo = $p->promo_nama
                    ? " | Promo: {$p->promo_nama} ({$p->potongan_harga}%)"
                    : "";

                $productList .= "- {$p->nama} | Kategori: {$p->kategori} | Harga: Rp {$p->harga_satuan} | Stok: {$p->kuantitas}{$promoInfo}\n";
            }
        }

        // ============================
        // 🔥 INSTRUKSI KETAT UNTUK AI
        // ============================
        $systemInstruction = "
Kamu adalah Chatbot resmi Toko ADRCatalog.
Jawab HANYA berdasarkan data berikut:

DAFTAR PRODUK:
$productList

Aturan:
- Hanya menjawab tentang produk, stok, harga, kategori, detail barang, atau layanan toko.
- Jika user menanyakan selain itu, jawab: 'Maaf, saya hanya dapat membantu terkait produk ADRCatalog.'
- Jika produk tidak ditemukan dalam database: jawab 'Maaf, produk yang Anda cari belum tersedia.'
- Jangan mengarang jawaban.
- Jangan gunakan markdown seperti **, *, _, ~, atau #.
";

        try {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => $apiKey,
            ])->post('https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent', [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => "INSTRUKSI SISTEM:\n$systemInstruction\n\nPERTANYAAN USER:\n$message"]
                        ]
                    ]
                ]
            ]);

            $data = $response->json();

            if ($response->failed()) {
                return response()->json([
                    'reply' => '⚠️ Gagal mendapatkan respons: ' . ($data['error']['message'] ?? 'Tidak diketahui')
                ]);
            }

            // Ambil jawaban AI
            $reply = $data['candidates'][0]['content']['parts'][0]['text']
                    ?? 'Maaf, tidak menerima balasan dari AI.';

            // Bersihkan markdown
            $reply = $this->bersihkanMarkdown($reply);

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            return response()->json([
                'reply' => '⚠️ Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // =========================
    // 🔥 Hapus Formatting Markdown
    // =========================
    private function bersihkanMarkdown($text)
    {
        return preg_replace('/[*_~`>#\/]/', '', $text);
    }
}