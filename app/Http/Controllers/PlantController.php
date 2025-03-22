<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
    {
        $plants = Plant::with('category')->get();
        return response()->json($plants);
    }


    public function show($slug)
    {
        $plant = Plant::where('slug', $slug)->with('category')->first();
        if (!$plant) {
            return response()->json(['message' => 'Plant not found'], 404);
        }
        return response()->json($plant);
    }
}
