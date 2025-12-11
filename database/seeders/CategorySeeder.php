<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['nama' => 'Pipa', 'path_thumbnail' => 'categories/Pipa.jpg'],
            ['nama' => 'Keran & Katup', 'path_thumbnail' => 'categories/Keran.jpg'],
            ['nama' => 'Shower & Floor Drain', 'path_thumbnail' => 'categories/Shower.jpg'],
            ['nama' => 'Aksesori Wastafel', 'path_thumbnail' => 'categories/Wastafel.jpg'],
            ['nama' => 'Perlengkapan Plumbing', 'path_thumbnail' => 'categories/Plumbing.jpg'],
            ['nama' => 'Kunci & Tang', 'path_thumbnail' => 'categories/Kunci.jpg'],
            ['nama' => 'Krisbow', 'path_thumbnail' => 'categories/Krisbow.jpg'],
            ['nama' => 'Tekiro', 'path_thumbnail' => 'categories/Tekiro.jpg'],
            ['nama' => 'C-Mart', 'path_thumbnail' => 'categories/C-Mart.jpg'],
            ['nama' => 'Lampu', 'path_thumbnail' => 'categories/Lampu.jpg'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
