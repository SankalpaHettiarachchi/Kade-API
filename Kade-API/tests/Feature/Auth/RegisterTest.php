<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

it('allows a user to register', function () {
    $user = [
        'name' => 'isurukala hetiiarachchi',
        'email' => 'example@gmail.com',
        'address' => 'hospital road kolonna',
        'password' => 'Sa489684354',
        'password_confirmation' => 'Sa489684354',
    ];

    $response = $this->post('api/user/register',$user);
    $response->assertStatus(201)
                ->assertJsonStructure([
                    'token',
                    'name',
                    'email',
                    'address',
                ]);

    $this->assertDatabaseHas('users', [
        'email' => 'example@gmail.com',
    ]);
});
