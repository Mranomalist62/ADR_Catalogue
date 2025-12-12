<?php
// database/seeders/ProductSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Promo;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Original products
            [
                'nama' => 'Pipa PVC 2 inch',
                'kuantitas' => 50,
                'id_kategori' => 1,
                'harga_satuan' => 25000,
                'desc' => 'Pipa PVC berkualitas untuk instalasi air.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Keran Air Minimalis',
                'kuantitas' => 30,
                'id_kategori' => 2,
                'harga_satuan' => 75000,
                'desc' => 'Keran air dengan desain modern dan tahan lama.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Shower Set 3 Fungsi',
                'kuantitas' => 20,
                'id_kategori' => 3,
                'harga_satuan' => 150000,
                'desc' => 'Shower set dengan 3 fungsi semprot, mudah dipasang.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Aksesori Wastafel 5 pcs',
                'kuantitas' => 40,
                'id_kategori' => 4,
                'harga_satuan' => 50000,
                'desc' => 'Set aksesori wastafel lengkap untuk rumah.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Kunci Inggris 12 inch',
                'kuantitas' => 25,
                'id_kategori' => 6,
                'harga_satuan' => 60000,
                'desc' => 'Kunci Inggris kuat dan tahan lama.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Tekiro Obeng Set 6 pcs',
                'kuantitas' => 35,
                'id_kategori' => 8,
                'harga_satuan' => 45000,
                'desc' => 'Obeng set dari Tekiro, cocok untuk rumah dan bengkel.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'C-Mart Palu Kecil',
                'kuantitas' => 50,
                'id_kategori' => 9,
                'harga_satuan' => 30000,
                'desc' => 'Palu ringan dan nyaman digunakan.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Lampu LED 9W',
                'kuantitas' => 100,
                'id_kategori' => 10,
                'harga_satuan' => 40000,
                'desc' => 'Lampu LED hemat energi, terang dan tahan lama.',
                'path_thumbnail' => null,
            ],

            // Additional products
            [
                'nama' => 'Pipa PVC 3 inch',
                'kuantitas' => 40,
                'id_kategori' => 1,
                'harga_satuan' => 35000,
                'desc' => 'Pipa PVC diameter 3 inch untuk instalasi besar.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Pipa Galvanis 1/2 inch',
                'kuantitas' => 25,
                'id_kategori' => 1,
                'harga_satuan' => 45000,
                'desc' => 'Pipa galvanis anti karat untuk instalasi air.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Keran Air Otomatis',
                'kuantitas' => 15,
                'id_kategori' => 2,
                'harga_satuan' => 120000,
                'desc' => 'Keran air otomatis dengan sensor gerak.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Katup Ball Valve 1 inch',
                'kuantitas' => 30,
                'id_kategori' => 2,
                'harga_satuan' => 55000,
                'desc' => 'Katup ball valve untuk kontrol aliran air.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Shower Rain 8 inch',
                'kuantitas' => 18,
                'id_kategori' => 3,
                'harga_satuan' => 180000,
                'desc' => 'Shower rain dengan tekanan air maksimal.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Floor Drain Stainless',
                'kuantitas' => 35,
                'id_kategori' => 3,
                'harga_satuan' => 75000,
                'desc' => 'Floor drain stainless steel anti karat.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Sifon Wastafel Chrome',
                'kuantitas' => 50,
                'id_kategori' => 4,
                'harga_satuan' => 35000,
                'desc' => 'Sifon wastafel chrome finish premium.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Elbow PVC 90 Derajat',
                'kuantitas' => 100,
                'id_kategori' => 5,
                'harga_satuan' => 8000,
                'desc' => 'Elbow PVC untuk belokan pipa 90 derajat.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Kunci Adjustable 10 inch',
                'kuantitas' => 20,
                'id_kategori' => 6,
                'harga_satuan' => 85000,
                'desc' => 'Kunci adjustable untuk berbagai ukuran mur.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Krisbow Obeng Set 12pcs',
                'kuantitas' => 25,
                'id_kategori' => 7,
                'harga_satuan' => 95000,
                'desc' => 'Set obeng Krisbow lengkap 12 buah.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Tekiro Tang Kombinasi 8 inch',
                'kuantitas' => 30,
                'id_kategori' => 8,
                'harga_satuan' => 65000,
                'desc' => 'Tang kombinasi Tekiro untuk berbagai keperluan.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'C-Mart Bor Beton 10mm',
                'kuantitas' => 15,
                'id_kategori' => 9,
                'harga_satuan' => 120000,
                'desc' => 'Bor beton C-Mart dengan mata bor 10mm.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Lampu LED Downlight 12W',
                'kuantitas' => 60,
                'id_kategori' => 10,
                'harga_satuan' => 55000,
                'desc' => 'Lampu LED downlight hemat energi 12 watt.',
                'path_thumbnail' => null,
            ],
            [
                'nama' => 'Lampu Emergency LED',
                'kuantitas' => 35,
                'id_kategori' => 10,
                'harga_satuan' => 85000,
                'desc' => 'Lampu emergency otomatis menyala saat listrik mati.',
                'path_thumbnail' => null,
            ],
        ];

        // Create products first
        $createdProducts = [];
        foreach ($products as $productData) {
            $product = Product::create($productData);
            $createdProducts[] = $product;
        }

        // Now create promos that reference the products
        $discounts = [10, 15, 20, 5, 10, 10, 5, 10, 15, 20, 10, 5, 15, 10, 20, 5, 10, 15, 10, 20, 10, 30];

        foreach ($createdProducts as $index => $product) {
            Promo::create([
                'product_id' => $product->id,
                'nama' => 'Diskon ' . ($discounts[$index]) . '% ' . $product->nama,
                'potongan_harga' => $discounts[$index],
                'path_thumbnail' => null,
            ]);
        }
    }
}
