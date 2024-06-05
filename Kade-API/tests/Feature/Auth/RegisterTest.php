<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

it('allows a user to register', function () {
    $response = $this->post('api/user/register', [
        'name' => 'isurukala hetiiarachchi',
        'email' => 'example@gmail.com',
        'address' => 'hospital road kolonna',
        'password' => 'Sa489684354',
        'password_confirmation' => 'Sa489684354',
    ]);
    $responseData = $response->json();

    $response->assertStatus(201);

    $this->assertDatabaseHas('users', [
        'email' => 'example@gmail.com',
    ]);
});
