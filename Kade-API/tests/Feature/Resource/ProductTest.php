<?php
use App\Models\Product;
use App\Models\User;

beforeEach(function() {
    $this->user = User::factory()->create();
});

it('Authenticated user can get all product', function () {
    $this->actingAs($this->user)
    ->get('/api/product')
    ->assertStatus(200);
});

