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
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Keran Air Minimalis',
                'kuantitas' => 30,
                'id_kategori' => 3, // Keran
                'desc' => 'Keran air dengan desain modern dan tahan lama.',
                'harga_satuan' => 75000,
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Shower Set 3 Fungsi',
                'kuantitas' => 20,
                'id_kategori' => 4, // Shower
                'desc' => 'Shower set dengan 3 fungsi semprot, mudah dipasang.',
                'harga_satuan' => 150000,
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Aksesori Wastafel 5 pcs',
                'kuantitas' => 40,
                'id_kategori' => 5, // Aksesoris
                'desc' => 'Set aksesori wastafel lengkap untuk rumah.',
                'harga_satuan' => 50000,
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Kunci Inggris 12 inch',
                'kuantitas' => 25,
                'id_kategori' => 7, // Perkakas
                'desc' => 'Kunci Inggris kuat dan tahan lama.',
                'harga_satuan' => 60000,
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Tekiro Obeng Set 6 pcs',
                'kuantitas' => 35,
                'id_kategori' => 9, // Perkakas Tangan
                'desc' => 'Obeng set dari Tekiro, cocok untuk rumah dan bengkel.',
                'harga_satuan' => 45000,
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'C-Mart Palu Kecil',
                'kuantitas' => 50,
                'id_kategori' => 10, // Perkakas Material
                'desc' => 'Palu ringan dan nyaman digunakan.',
                'harga_satuan' => 30000,
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Lampu LED 9W',
                'kuantitas' => 100,
                'id_kategori' => 11, // Elektronik
                'desc' => 'Lampu LED hemat energi, terang dan tahan lama.',
                'harga_satuan' => 40000,
                'path_thumbnail' => null,
            ],
        ];

        // Promo data separately
        $promos = [
            [
                'product_id' => 1, // Pipa PVC 2 inch
                'nama' => 'Diskon Pipa 10%',
                'potongan_harga' => 10,
                'path_thumbnail' => null,
            ],
            [
                'product_id' => 2, // Keran Air Minimalis
                'nama' => 'Promo Keran 15%',
                'potongan_harga' => 15,
                'path_thumbnail' => null,
            ],
            [
                'product_id' => 3, // Shower Set 3 Fungsi
                'nama' => 'Diskon Shower 20%',
                'potongan_harga' => 20,
                'path_thumbnail' => null,
            ],
            [
                'product_id' => 4, // Aksesori Wastafel 5 pcs
                'nama' => 'Promo Aksesori 5%',
                'potongan_harga' => 5,
                'path_thumbnail' => null,
            ],
            [
                'product_id' => 5, // Kunci Inggris 12 inch
                'nama' => 'Diskon Kunci 10%',
                'potongan_harga' => 10,
                'path_thumbnail' => null,
            ],
            [
                'product_id' => 6, // Tekiro Obeng Set 6 pcs
                'nama' => 'Promo Tekiro 10%',
                'potongan_harga' => 10,
                'path_thumbnail' => null,
            ],
            [
                'product_id' => 7, // C-Mart Palu Kecil
                'nama' => 'Diskon Palu 5%',
                'potongan_harga' => 5,
                'path_thumbnail' => null,
            ],
            [
                'product_id' => 8, // Lampu LED 9W
                'nama' => 'Promo Lampu 10%',
                'potongan_harga' => 10,
                'path_thumbnail' => null,
            ],
        ];

        foreach ($products as $productData) {
                $product = Product::create($productData);
            }

            // Then, seed promos
        foreach ($promos as $promoData) {
            Promo::create($promoData);
        }


    }
}
