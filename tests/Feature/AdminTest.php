<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminTest extends \Tests\TestCase
{
    public function test_admin_can_create_category()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);

        $token = $this->postJson('/api/login', [
            'email' => $admin->email,
            'password' => 'password'
        ])->json('token');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->postJson('/api/admin/categories', [
            'name' => 'Herbs',
            'slug' => 'herbs'
        ]);

        $response->assertStatus(201);
    }
}
