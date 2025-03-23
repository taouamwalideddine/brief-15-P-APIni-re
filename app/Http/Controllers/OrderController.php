<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function employeeIndex()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.plant')->get();
        return response()->json($orders);
    }

    public function employeeShow($id)
    {
        $order = Order::where('user_id', Auth::id())->with('items.plant')->find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.plant_id' => 'required|exists:plants,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'plant_id' => $item['plant_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
    }

public function employeeUpdate(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,prepared,delivered',
    ]);

    $order = Order::find($id);
    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    $order->status = $request->status;
    $order->save();

    return response()->json(['message' => 'Order status updated', 'order' => $order]);
}

    public function destroy($id)
    {
        $order = Order::where('user_id', Auth::id())->find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($order->status !== 'pending') {
            return response()->json(['message' => 'Order cannot be canceled'], 400);
        }

        $order->delete();
        return response()->json(['message' => 'Order canceled successfully']);
    }
}
