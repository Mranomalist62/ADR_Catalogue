<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Promo;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PromoModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test apakah model Promo dapat dibuat dengan data yang valid.
     */
    public function test_promo_can_be_created_with_valid_data(): void
    {
        $promo = Promo::create([
            'nama' => 'Diskon 11.11',
            'potongan_harga' => 150000,
            'path_thumbnail' => 'promo/1111.jpg',
        ]);

        // Verifikasi promo berhasil dibuat
        $this->assertDatabaseHas('promo', [
            'nama' => 'Diskon 11.11',
            'potongan_harga' => 150000,
            'path_thumbnail' => 'promo/1111.jpg',
        ]);

        $this->assertEquals('Diskon 11.11', $promo->nama);
        $this->assertEquals(150000, $promo->potongan_harga);
        $this->assertEquals('promo/1111.jpg', $promo->path_thumbnail);
    }

    /**
     * Test relasi promo dengan products (many to many).
     */
    public function test_promo_belongs_to_many_products(): void
    {
        // Buat category
        $category = Category::create([
            'nama' => 'Elektronik',
            'path_thumbnail' => 'category/electronics.jpg',
        ]);

        // Buat products
        $product1 = Product::create([
            'nama' => 'Laptop ASUS ROG',
            'kuantitas' => 10,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'products/laptop.jpg',
            'desc' => 'Laptop gaming high-end',
        ]);

        $product2 = Product::create([
            'nama' => 'iPhone 15 Pro',
            'kuantitas' => 15,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'products/iphone.jpg',
            'desc' => 'Smartphone flagship Apple',
        ]);

        // Buat promo
        $promo = Promo::create([
            'nama' => 'Flash Sale',
            'potongan_harga' => 500000,
            'path_thumbnail' => 'promo/flashsale.jpg',
        ]);

        // Attach products ke promo
        $promo->products()->attach([$product1->id, $product2->id]);

        // Test relasi
        $this->assertCount(2, $promo->products);
        $this->assertInstanceOf(Product::class, $promo->products->first());
        
        // Verifikasi products yang terattach
        $productIds = $promo->products->pluck('id')->toArray();
        $this->assertContains($product1->id, $productIds);
        $this->assertContains($product2->id, $productIds);
    }

    /**
     * Test fillable attributes pada model Promo.
     */
    public function test_promo_fillable_attributes(): void
    {
        $promo = new Promo([
            'nama' => 'Cashback Akhir Tahun',
            'potongan_harga' => 1000000,
            'path_thumbnail' => 'promo/cashback.jpg',
        ]);

        $this->assertEquals('Cashback Akhir Tahun', $promo->nama);
        $this->assertEquals(1000000, $promo->potongan_harga);
        $this->assertEquals('promo/cashback.jpg', $promo->path_thumbnail);
    }

    /**
     * Test promo creation tanpa nama.
     */
    public function test_promo_creation_without_name(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        
        Promo::create([
            'potongan_harga' => 100000,
            'path_thumbnail' => 'promo/test.jpg',
        ]);
    }

    /**
     * Test promo dengan potongan harga nol.
     */
    public function test_promo_with_zero_discount(): void
    {
        $promo = Promo::create([
            'nama' => 'Promo Gratis Ongkir',
            'potongan_harga' => 0,
            'path_thumbnail' => 'promo/freeongkir.jpg',
        ]);

        $this->assertNotNull($promo);
        $this->assertEquals(0, $promo->potongan_harga);
        $this->assertDatabaseHas('promo', [
            'nama' => 'Promo Gratis Ongkir',
            'potongan_harga' => 0,
        ]);
    }

    /**
     * Test promo dengan potongan harga negatif.
     */
    public function test_promo_with_negative_discount(): void
    {
        $promo = Promo::create([
            'nama' => 'Promo Biaya Admin',
            'potongan_harga' => -5000,
            'path_thumbnail' => 'promo/admin.jpg',
        ]);

        $this->assertNotNull($promo);
        $this->assertEquals(-5000, $promo->potongan_harga);
        $this->assertDatabaseHas('promo', [
            'nama' => 'Promo Biaya Admin',
            'potongan_harga' => -5000,
        ]);
    }

    /**
     * Test promo tanpa thumbnail.
     */
    public function test_promo_without_thumbnail(): void
    {
        $promo = Promo::create([
            'nama' => 'Promo Spesial',
            'potongan_harga' => 250000,
        ]);

        $this->assertNotNull($promo);
        $this->assertEquals('Promo Spesial', $promo->nama);
        $this->assertEquals(250000, $promo->potongan_harga);
        $this->assertNull($promo->path_thumbnail);
    }

    /**
     * Test relasi products pada promo kosong.
     */
    public function test_empty_promo_products_relationship(): void
    {
        $promo = Promo::create([
            'nama' => 'Promo Kosong',
            'potongan_harga' => 100000,
            'path_thumbnail' => 'promo/empty.jpg',
        ]);

        // Test relasi products yang kosong
        $this->assertCount(0, $promo->products);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $promo->products);
    }

    /**
     * Test detaching products dari promo.
     */
    public function test_detach_products_from_promo(): void
    {
        // Buat category dan product
        $category = Category::create([
            'nama' => 'Test Category',
            'path_thumbnail' => 'test.jpg',
        ]);

        $product = Product::create([
            'nama' => 'Test Product',
            'kuantitas' => 10,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'test.jpg',
            'desc' => 'Test description',
        ]);

        // Buat promo dan attach product
        $promo = Promo::create([
            'nama' => 'Test Promo',
            'potongan_harga' => 50000,
            'path_thumbnail' => 'promo/test.jpg',
        ]);

        $promo->products()->attach($product->id);
        $this->assertCount(1, $promo->products);

        // Detach product
        $promo->products()->detach($product->id);
        
        // Refresh relationship
        $promo->refresh();
        $this->assertCount(0, $promo->products);
    }
}