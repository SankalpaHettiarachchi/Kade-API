<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

it('allows a registered user to login', function () {
    $password = 'password123';
    $user = User::factory()->create([
        'password' => bcrypt($password),
    ]);

    $response = $this->postJson('api/user/login', [
        'email' => $user->email,
        'password' => $password,
    ]);
    $response->assertStatus(200);
    $responseData = $response->json();

    expect($response->json())->toHaveKey('token');
    $this->assertDatabaseHas('personal_access_tokens', [
        'tokenable_id' => $user->id,
        'name' => 'Personal Access Token',
    ]);
    $response->assertJsonStructure(['token']);
});

