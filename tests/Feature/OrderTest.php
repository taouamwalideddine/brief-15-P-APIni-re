<?php

namespace Tests\Feature;

use App\Models\Plant;
use App\Models\User;

class OrderTest extends \Tests\TestCase
{
    public function test_user_can_create_order()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $plant = Plant::create([
            'name' => 'Rosemary',
            'slug' => 'rosemary',
            'price' => 6.99
        ]);

        $response = $this->actingAs($user)->postJson('/api/orders', [
            'items' => [['plant_id' => $plant->id, 'quantity' => 2]]
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Order placed successfully']);
    }
}
