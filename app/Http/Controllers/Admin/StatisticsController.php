<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plant;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $totalSales = Order::where('status', 'delivered')->count();

        $popularPlants = Plant::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();

        $categoryDistribution = DB::table('plants')
            ->join('categories', 'plants.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('COUNT(plants.id) as plant_count'))
            ->groupBy('categories.name')
            ->get();

        return response()->json([
            'total_sales' => $totalSales,
            'popular_plants' => $popularPlants,
            'category_distribution' => $categoryDistribution,
        ]);
    }
}
