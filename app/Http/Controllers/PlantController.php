<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\DAO\PlantDAO;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    protected $plantDAO;

    public function __construct(PlantDAO $plantDAO)
    {
        $this->plantDAO = $plantDAO;
    }

    public function index()
    {
        $plants = $this->plantDAO->getAllPlants();
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
