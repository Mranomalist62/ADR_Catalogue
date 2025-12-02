<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Promo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test apakah model Product dapat dibuat dengan data yang valid.
     */
    public function test_product_can_be_created_with_valid_data(): void
    {
        // Buat category terlebih dahulu
        $category = Category::create([
            'nama' => 'Elektronik',
            'path_thumbnail' => 'category/electronics.jpg',
        ]);

        // Buat product dengan data valid
        $product = Product::create([
            'nama' => 'Laptop ASUS ROG',
            'kuantitas' => 10,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'products/laptop.jpg',
            'desc' => 'Laptop gaming high-end dengan spesifikasi tinggi',
        ]);

        // Verifikasi product berhasil dibuat
        $this->assertDatabaseHas('product', [
            'nama' => 'Laptop ASUS ROG',
            'kuantitas' => 10,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'products/laptop.jpg',
            'desc' => 'Laptop gaming high-end dengan spesifikasi tinggi',
        ]);
    }

    /**
     * Test relasi product dengan category.
     */
    public function test_product_belongs_to_category(): void
    {
        $category = Category::create([
            'nama' => 'Smartphone',
            'path_thumbnail' => 'category/smartphone.jpg',
        ]);

        $product = Product::create([
            'nama' => 'iPhone 15 Pro',
            'kuantitas' => 5,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'products/iphone15.jpg',
            'desc' => 'Smartphone flagship dari Apple',
        ]);

        // Test relasi
        $this->assertInstanceOf(Category::class, $product->category);
        $this->assertEquals($category->id, $product->category->id);
        $this->assertEquals('Smartphone', $product->category->nama);
    }

    /**
     * Test relasi product dengan promos (many to many).
     */
    public function test_product_belongs_to_many_promos(): void
    {
        // Buat category
        $category = Category::create([
            'nama' => 'Elektronik',
            'path_thumbnail' => 'category/electronics.jpg',
        ]);

        // Buat product
        $product = Product::create([
            'nama' => 'Samsung Galaxy S24',
            'kuantitas' => 15,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'products/galaxys24.jpg',
            'desc' => 'Smartphone Android flagship',
        ]);

        // Buat promos
        $promo1 = Promo::create([
            'nama' => 'Diskon 10%',
            'potongan_harga' => 10,
            'path_thumbnail' => 'promo/discount10.jpg',
        ]);

        $promo2 = Promo::create([
            'nama' => 'Cashback 500K',
            'potongan_harga' => 500000,
            'path_thumbnail' => 'promo/cashback500.jpg',
        ]);

        // Attach promos ke product
        $product->promos()->attach([$promo1->id, $promo2->id]);

        // Test relasi
        $this->assertCount(2, $product->promos);
        $this->assertInstanceOf(Promo::class, $product->promos->first());
        
        // Verifikasi promo yang terattach
        $promoIds = $product->promos->pluck('id')->toArray();
        $this->assertContains($promo1->id, $promoIds);
        $this->assertContains($promo2->id, $promoIds);
    }

    /**
     * Test relasi product dengan orders (one to many).
     */
    public function test_product_has_many_orders(): void
    {
        $category = Category::create([
            'nama' => 'Fashion',
            'path_thumbnail' => 'category/fashion.jpg',
        ]);

        $product = Product::create([
            'nama' => 'Nike Air Max',
            'kuantitas' => 20,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'products/nikeairmax.jpg',
            'desc' => 'Sepatu olahraga nyaman',
        ]);

        // Test relasi orders
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $product->orders);
    }

    /**
     * Test fillable attributes pada model Product.
     */
    public function test_product_fillable_attributes(): void
    {
        $category = Category::create([
            'nama' => 'Test Category',
            'path_thumbnail' => 'test.jpg',
        ]);

        $product = new Product([
            'nama' => 'Test Product',
            'kuantitas' => 100,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'test/product.jpg',
            'desc' => 'Test description',
        ]);

        $this->assertEquals('Test Product', $product->nama);
        $this->assertEquals(100, $product->kuantitas);
        $this->assertEquals($category->id, $product->id_kategori);
        $this->assertEquals('test/product.jpg', $product->path_thumbnail);
        $this->assertEquals('Test description', $product->desc);
    }

    /**
     * Test product creation tanpa category.
     */
    public function test_product_creation_without_category(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        
        Product::create([
            'nama' => 'Product Without Category',
            'kuantitas' => 10,
            'path_thumbnail' => 'test.jpg',
            'desc' => 'Test description',
        ]);
    }

    /**
     * Test product dengan kuantitas negatif.
     */
    public function test_product_with_negative_quantity(): void
    {
        $category = Category::create([
            'nama' => 'Test Category',
            'path_thumbnail' => 'test.jpg',
        ]);

        // Product dengan kuantitas negatif seharusnya bisa dibuat
        // (validasi harus di level aplikasi, bukan database)
        $product = Product::create([
            'nama' => 'Product with Negative Quantity',
            'kuantitas' => -5,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'test.jpg',
            'desc' => 'Test description',
        ]);

        $this->assertEquals(-5, $product->kuantitas);
        $this->assertDatabaseHas('product', [
            'nama' => 'Product with Negative Quantity',
            'kuantitas' => -5,
        ]);
    }
}