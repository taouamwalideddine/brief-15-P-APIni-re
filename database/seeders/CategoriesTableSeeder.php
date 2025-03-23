<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = ['Flowers', 'Succulents', 'Herbs', 'Trees', 'Shrubs'];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
