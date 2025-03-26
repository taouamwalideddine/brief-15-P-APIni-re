<?php
namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAll()
    {
        return Order::with(['user', 'items.plant'])->get();
    }

    public function getById(int $id)
    {
        return Order::with(['user', 'items.plant'])->find($id);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function updateStatus(int $id, string $status)
    {
        $order = Order::find($id);
        if (!$order) return false;

        $order->status = $status;
        return $order->save();
    }

    public function delete(int $id)
    {
        $order = Order::find($id);
        return $order ? $order->delete() : false;
    }

    public function getOrderItems(int $orderId)
    {
        return Order::find($orderId)->items()->with('plant')->get();
    }
}
