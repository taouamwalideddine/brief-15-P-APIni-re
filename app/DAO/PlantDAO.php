<?php

namespace App\DAO;

use App\Models\Plant;
use Illuminate\Support\Collection;

class PlantDAO
{
    // Get all plants
    public function getAllPlants(): Collection
    {
        return Plant::with('category')->get();
    }
}
