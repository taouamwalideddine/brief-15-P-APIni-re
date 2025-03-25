<?php

namespace App\Repositories\Eloquent;

use App\Models\Plant;
use App\Repositories\Interfaces\PlantRepositoryInterface;

class PlantRepository implements PlantRepositoryInterface
{
    public function getAll()
    {
        return Plant::with('category')->get();
    }

    public function getBySlug(string $slug)
    {
        return Plant::where('slug', $slug)->with('category')->first();
    }

    public function create(array $data)
    {
        return Plant::create($data);
    }

    public function update(int $id, array $data)
    {
        $plant = Plant::find($id);
        return $plant ? $plant->update($data) : false;
    }

    public function delete(int $id)
    {
        $plant = Plant::find($id);
        return $plant ? $plant->delete() : false;
    }
}
