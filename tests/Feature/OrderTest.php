<?php
namespace Tests\Feature;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OrderTest extends \Tests\TestCase
{
    public function test_user_can_create_order()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password')
        ]);

        $plant = Plant::factory()->create();

        $token = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ])->json('token');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->postJson('/api/orders', [
            'items' => [['plant_id' => $plant->id, 'quantity' => 2]]
        ]);

        $response->assertStatus(201);
    }
}
