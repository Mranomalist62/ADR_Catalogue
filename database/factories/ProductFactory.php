<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->words(3, true),
            'kuantitas' => fake()->numberBetween(1, 100),
            'id_kategori' => \App\Models\Category::factory(),
            'path_thumbnail' => 'products/' . fake()->uuid() . '.jpg',
            'desc' => fake()->sentence(10),
        ];
    }
}