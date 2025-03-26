<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::all();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(int $id, array $data)
    {
        $category = Category::find($id);
        return $category ? $category->update($data) : false;
    }

    public function delete(int $id)
    {
        $category = Category::find($id);
        return $category ? $category->delete() : false;
    }
}
