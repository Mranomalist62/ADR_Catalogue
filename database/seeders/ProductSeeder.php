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
        ];

        // Create products first
        $createdProducts = [];
        foreach ($products as $productData) {
            $product = Product::create($productData);
            $createdProducts[] = $product;
        }

        // Now create promos that reference the products
        $discounts = [10, 15, 20, 5, 10, 10, 5, 10];

        foreach ($createdProducts as $index => $product) {
            Promo::create([
                'product_id' => $product->id, // This links promo to product
                'nama' => 'Diskon ' . ($discounts[$index]) . '% ' . $product->nama,
                'potongan_harga' => $discounts[$index],
                'path_thumbnail' => null,
            ]);
        }

        // NO NEED to update product with promo_id anymore!
    }
}
