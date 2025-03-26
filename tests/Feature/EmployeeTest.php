<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;

class EmployeeTest extends \Tests\TestCase
{
    public function test_employee_can_update_order_status()
    {
        $employee = User::create([
            'name' => 'Employee',
            'email' => 'employee@example.com',
            'password' => 'password123',
            'role' => 'employee'
        ]);

        $order = Order::create([
            'user_id' => 1,
            'status' => 'pending'
        ]);

        $response = $this->actingAs($employee)
            ->putJson("/api/employee/orders/{$order->id}", [
                'status' => 'prepared'
            ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Order status updated']);
    }
}
