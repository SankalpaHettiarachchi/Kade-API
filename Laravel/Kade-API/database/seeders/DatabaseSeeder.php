<?php

namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Models\Image;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Product::factory(50)->create();
        Image::factory(50)->create();
        Payment::factory(50)->create();
        Cart::factory(50)->create();
        Admin::factory(5)->create();
    }
}
