<?php

namespace Tests\Feature;

use App\Models\User;

class AdminTest extends \Tests\TestCase
{
    public function test_admin_can_create_category()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)
            ->postJson('/api/admin/categories', [
                'name' => 'Herbs',
                'slug' => 'herbs'
            ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Category created']);
    }
}
