<?php
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('alowes to loged user logout', function () {
        // Create a user
        $user = User::factory()->create();

        // Act as the created user and perform the logout request
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('api/user/logout');

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains the correct message
        $response->assertJson(['message' => 'Logged out successfully']);

        //check the token is still available
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'name' => 'Personal Access Token',
        ]);
});
