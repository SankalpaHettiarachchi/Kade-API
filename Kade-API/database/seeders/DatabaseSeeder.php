<?php

namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        Product::factory(1)->create();
        Payment::factory(1)->create();
        Cart::factory(5)->create();
        Admin::factory(1)->create();
    }
}
