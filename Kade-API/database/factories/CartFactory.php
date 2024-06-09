<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> \App\Models\User::factory(),
            'product_id'=> \App\Models\Product::factory(),
            'quantity'=>\App\Models\Product::factory(),
            'sub_total'=> \App\Models\Product::factory(),
        ];
    }
}
