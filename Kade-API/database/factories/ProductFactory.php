<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'user_id'=> User::factory(),
            'image_url'=> fake()->filePath(),
            'name'=> fake()->name(),
            'description'=> fake()->text(),
            'quantity'=> fake()->numberBetween(0,100),
            'unit'=> fake()->word(),
            'unit_price'=> fake()->numberBetween(100,1000),
            'av_quantity'=> fake()->numberBetween(100,1000),
        ];
    }
}
