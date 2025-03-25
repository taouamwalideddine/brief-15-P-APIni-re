<?php

namespace App\DAO;

use App\Models\Plant;
use Illuminate\Support\Collection;

class PlantDAO
{

    public function getAllPlants(): Collection
    {
        return Plant::with('category')->get();
    }
}
