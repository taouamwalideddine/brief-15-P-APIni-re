<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeTest extends \Tests\TestCase
{
    public function test_employee_can_update_order_status()
    {
        $employee = User::factory()->create([
            'role' => 'employee',
            'password' => Hash::make('password')
        ]);

        $order = Order::factory()->create();

        $token = $this->postJson('/api/login', [
            'email' => $employee->email,
            'password' => 'password'
        ])->json('token');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->putJson("/api/employee/orders/{$order->id}", [
            'status' => 'prepared'
        ]);

        $response->assertStatus(200);
    }
}
