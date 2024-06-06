<?php
use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function() {
    $this->user = User::factory()->create();
});

it('Authenticated user can get all product', function () {
    $this->actingAs($this->user)
    ->get('/api/product')
    ->assertStatus(200);
});

it('Authenticated seller can create a product', function () {
    $user = Sanctum::actingAs($this->user);
    $product = Product::factory()->create()->toArray();
    $this->actingAs($user)
    ->post('/api/product',$product)
    ->assertStatus(200);
});
