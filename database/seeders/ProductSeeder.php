<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Promo;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'nama' => 'Pipa PVC 2 inch',
                'kuantitas' => 50,
                'id_kategori' => 2, // Pipa
                'desc' => 'Pipa PVC berkualitas untuk instalasi air.',
                'harga_satuan' => 25000,
                'thumbnail' => null,
                'promo_nama' => 'Diskon Pipa 10%',
                'promo_potongan' => 10
            ],
            [
                'nama' => 'Keran Air Minimalis',
                'kuantitas' => 30,
                'id_kategori' => 3, // Keran & Katup
                'desc' => 'Keran air dengan desain modern dan tahan lama.',
                'harga_satuan' => 75000,
                'thumbnail' => null,
                'promo_nama' => 'Promo Keran 15%',
                'promo_potongan' => 15
            ],
            [
                'nama' => 'Shower Set 3 Fungsi',
                'kuantitas' => 20,
                'id_kategori' => 4, // Shower & Floor Drain
                'desc' => 'Shower set dengan 3 fungsi semprot, mudah dipasang.',
                'harga_satuan' => 150000,
                'thumbnail' => null,
                'promo_nama' => 'Diskon Shower 20%',
                'promo_potongan' => 20
            ],
            [
                'nama' => 'Aksesori Wastafel 5 pcs',
                'kuantitas' => 40,
                'id_kategori' => 5, // Aksesori Wastafel
                'desc' => 'Set aksesori wastafel lengkap untuk rumah.',
                'harga_satuan' => 50000,
                'thumbnail' => null,
                'promo_nama' => 'Promo Aksesori 5%',
                'promo_potongan' => 5
            ],
            [
                'nama' => 'Kunci Inggris 12 inch',
                'kuantitas' => 25,
                'id_kategori' => 7, // Kunci & Tang
                'desc' => 'Kunci Inggris kuat dan tahan lama.',
                'harga_satuan' => 60000,
                'thumbnail' => null,
                'promo_nama' => 'Diskon Kunci 10%',
                'promo_potongan' => 10
            ],
            [
                'nama' => 'Tekiro Obeng Set 6 pcs',
                'kuantitas' => 35,
                'id_kategori' => 9, // Tekiro
                'desc' => 'Obeng set dari Tekiro, cocok untuk rumah dan bengkel.',
                'harga_satuan' => 45000,
                'thumbnail' => null,
                'promo_nama' => 'Promo Tekiro 10%',
                'promo_potongan' => 10
            ],
            [
                'nama' => 'C-Mart Palu Kecil',
                'kuantitas' => 50,
                'id_kategori' => 10, // C-Mart
                'desc' => 'Palu ringan dan nyaman digunakan.',
                'harga_satuan' => 30000,
                'thumbnail' => null,
                'promo_nama' => 'Diskon Palu 5%',
                'promo_potongan' => 5
            ],
            [
                'nama' => 'Lampu LED 9W',
                'kuantitas' => 100,
                'id_kategori' => 11, // Lampu
                'desc' => 'Lampu LED hemat energi, terang dan tahan lama.',
                'harga_satuan' => 40000,
                'thumbnail' => null,
                'promo_nama' => 'Promo Lampu 10%',
                'promo_potongan' => 10
            ]
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'nama' => $item['nama'],
                'kuantitas' => $item['kuantitas'],
                'id_kategori' => $item['id_kategori'],
                'desc' => $item['desc'],
                'harga_satuan' => $item['harga_satuan'],
                'path_thumbnail' => $item['thumbnail']
            ]);

            Promo::create([
                'product_id' => $product->id,
                'nama' => $item['promo_nama'],
                'potongan_harga' => $item['promo_potongan']
            ]);
        }
    }
}
