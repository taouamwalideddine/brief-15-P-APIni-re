<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image_url' => 'nullable|string',
            'slug' => 'required|string|unique:plants',
            'category_id' => 'required|exists:categories,id',
        ]);

        $plant = Plant::create($request->all());

        return response()->json(['message' => 'Plant created successfully', 'plant' => $plant], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'image_url' => 'nullable|string',
            'slug' => 'sometimes|string|unique:plants,slug,' . $id,
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $plant = Plant::find($id);
        if (!$plant) {
            return response()->json(['message' => 'Plant not found'], 404);
        }

        $plant->update($request->all());

        return response()->json(['message' => 'Plant updated successfully', 'plant' => $plant]);
    }
}
