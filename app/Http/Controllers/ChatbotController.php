<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function reply(Request $request)
    {
        $message = trim($request->input('message')); 
        $apiKey  = env('GOOGLE_API_KEY');

        $now   = now()->timezone('Asia/Jakarta');
        $start = now()->timezone('Asia/Jakarta')->setTime(8, 0);
        $end   = now()->timezone('Asia/Jakarta')->setTime(22, 0);

        $nowTime = $now->format('H:i');

        $adminOnline =
            ($nowTime >= '08:00' && $nowTime <= '22:00');

        if ($adminOnline) {
            return response()->json([
                'reply' => 'Admin sedang online. Silakan tunggu balasan admin.'
            ]);
        }

        // ======================
        // DATA PRODUK + KATEGORI + PROMO
        // ======================
        $products = DB::table('product')
            ->join('category', 'product.id_kategori', '=', 'category.id')
            ->leftJoin('promo', 'promo.product_id', '=', 'product.id')
            ->select(
                'product.nama',
                'product.kuantitas',
                'product.harga_satuan',
                'category.nama as kategori',
                'promo.nama as promo',
                'promo.potongan_harga'
            )
            ->get();

        $productList = "";

        foreach ($products as $p) {
            $promoInfo = $p->promo
                ? " | Promo: {$p->promo} ({$p->potongan_harga}%)"
                : "";

            $productList .= "- {$p->nama}
  Kategori: {$p->kategori}
  Harga: Rp {$p->harga_satuan}
  Stok: {$p->kuantitas}{$promoInfo}\n";
        }

        if ($productList === "") {
            $productList = "Tidak ada produk tersedia.";
        }

        // ======================
        // DATA KATEGORI
        // ======================
        $categories = DB::table('category')->pluck('nama')->implode(', ');

        // ======================
        // DATA PROMO
        // ======================
        $promos = DB::table('promo')
            ->select('nama', 'potongan_harga')
            ->get();

        $promoList = "";
        foreach ($promos as $promo) {
            $promoList .= "- {$promo->nama} ({$promo->potongan_harga}%)\n";
        }

        if ($promoList === "") {
            $promoList = "Tidak ada promo aktif.";
        }

        // ======================
        // DATA ORDER USER (JIKA LOGIN)
        // ======================
        $orderInfo = "User belum login.";

        if (Auth::guard('user')->check()) {
            $userId = Auth::guard('user')->id();

            $orders = DB::table('order')
                ->where('id_pemesan', $userId)
                ->select('status', 'total_harga', 'payment_method')
                ->latest()
                ->limit(3)
                ->get();

            if ($orders->isNotEmpty()) {
                $orderInfo = "";
                foreach ($orders as $o) {
                    $orderInfo .= "- Status: {$o->status}, Total: Rp {$o->total_harga}, Metode: {$o->payment_method}\n";
                }
            } else {
                $orderInfo = "Belum ada pesanan.";
            }
        }

        // ======================
        // INSTRUKSI SISTEM AI
        // ======================
        $systemInstruction = "
Kamu adalah Chatbot resmi Toko ADRCatalog.

DATA PRODUK:
$productList

KATEGORI:
$categories

PROMO:
$promoList

ORDER USER:
$orderInfo

ATURAN KETAT:
- Jawab hanya berdasarkan data di atas
- Jangan mengarang jawaban
- Jangan menampilkan data sensitif
- Jika tidak ditemukan, jawab sopan
- Jangan gunakan markdown atau simbol aneh
";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => $apiKey,
            ])->post(
                'https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent',
                [
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => "INSTRUKSI:\n$systemInstruction\n\nPERTANYAAN USER:\n$message"]
                            ]
                        ]
                    ]
                ]
            );

            $data = $response->json();

            if ($response->failed()) {
                return response()->json([
                    'reply' => 'Maaf, sistem sedang bermasalah.'
                ]);
            }

            $reply = $data['candidates'][0]['content']['parts'][0]['text']
                ?? 'Maaf, saya tidak dapat menjawab pertanyaan tersebut.';

            return response()->json([
                'reply' => $this->cleanText($reply)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'reply' => 'Terjadi kesalahan sistem.'
            ]);
        }
    }

    private function cleanText($text)
    {
        return preg_replace('/[*_~`>#]/', '', $text);
    }
}