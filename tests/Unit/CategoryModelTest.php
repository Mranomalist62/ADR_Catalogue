<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test apakah model Category dapat dibuat dengan data yang valid.
     */
    public function test_category_can_be_created_with_valid_data(): void
    {
        $category = Category::create([
            'nama' => 'Elektronik',
            'path_thumbnail' => 'category/electronics.jpg',
        ]);

        // Verifikasi category berhasil dibuat
        $this->assertDatabaseHas('category', [
            'nama' => 'Elektronik',
            'path_thumbnail' => 'category/electronics.jpg',
        ]);

        $this->assertEquals('Elektronik', $category->nama);
        $this->assertEquals('category/electronics.jpg', $category->path_thumbnail);
    }

    /**
     * Test relasi category dengan products (one to many).
     */
    public function test_category_has_many_products(): void
    {
        // Buat category
        $category = Category::create([
            'nama' => 'Smartphone',
            'path_thumbnail' => 'category/smartphone.jpg',
        ]);

        // Buat products untuk category ini
        $product1 = Product::create([
            'nama' => 'iPhone 15 Pro',
            'kuantitas' => 10,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'products/iphone15.jpg',
            'desc' => 'Smartphone flagship dari Apple',
        ]);

        $product2 = Product::create([
            'nama' => 'Samsung Galaxy S24',
            'kuantitas' => 15,
            'id_kategori' => $category->id,
            'path_thumbnail' => 'products/galaxys24.jpg',
            'desc' => 'Smartphone Android flagship',
        ]);

        // Test relasi
        $this->assertCount(2, $category->products);
        $this->assertInstanceOf(Product::class, $category->products->first());
        
        // Verifikasi products yang terkait
        $productIds = $category->products->pluck('id')->toArray();
        $this->assertContains($product1->id, $productIds);
        $this->assertContains($product2->id, $productIds);
    }

    /**
     * Test fillable attributes pada model Category.
     */
    public function test_category_fillable_attributes(): void
    {
        $category = new Category([
            'nama' => 'Fashion',
            'path_thumbnail' => 'category/fashion.jpg',
        ]);

        $this->assertEquals('Fashion', $category->nama);
        $this->assertEquals('category/fashion.jpg', $category->path_thumbnail);
    }

    /**
     * Test category creation tanpa nama.
     */
    public function test_category_creation_without_name(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        
        Category::create([
            'path_thumbnail' => 'category/test.jpg',
        ]);
    }

    /**
     * Test category dengan nama yang sama.
     */
    public function test_category_with_duplicate_name(): void
    {
        // Buat category pertama
        Category::create([
            'nama' => 'Elektronik',
            'path_thumbnail' => 'category/electronics1.jpg',
        ]);

        // Coba buat category dengan nama yang sama
        // (tergantung pada constraint database, mungkin berhasil atau gagal)
        $category2 = Category::create([
            'nama' => 'Elektronik',
            'path_thumbnail' => 'category/electronics2.jpg',
        ]);

        // Verifikasi category kedua berhasil dibuat
        $this->assertNotNull($category2);
        $this->assertEquals('Elektronik', $category2->nama);
    }

    /**
     * Test category tanpa thumbnail.
     */
    public function test_category_without_thumbnail(): void
    {
        $category = Category::create([
            'nama' => 'Books',
        ]);

        $this->assertNotNull($category);
        $this->assertEquals('Books', $category->nama);
        $this->assertNull($category->path_thumbnail);
    }

    /**
     * Test relasi products pada category kosong.
     */
    public function test_empty_category_products_relationship(): void
    {
        $category = Category::create([
            'nama' => 'Empty Category',
            'path_thumbnail' => 'category/empty.jpg',
        ]);

        // Test relasi products yang kosong
        $this->assertCount(0, $category->products);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->products);
    }
}