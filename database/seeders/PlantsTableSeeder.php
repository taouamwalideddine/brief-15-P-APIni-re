<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PlantsTableSeeder extends Seeder
{
    public function run()
    {
        $category1 = Category::firstOrCreate(['name' => 'Flowers'], ['slug' => 'flowers']);
        $category2 = Category::firstOrCreate(['name' => 'Succulents'], ['slug' => 'succulents']);

        Plant::create([
            'name' => 'Rose',
            'description' => 'A beautiful red rose.',
            'price' => 12.99,
            'image_url' => 'https://example.com/rose.jpg',
            'slug' => 'rose',
            'category_id' => $category1->id,
        ]);

        Plant::create([
            'name' => 'Aloe Vera',
            'description' => 'A healing succulent plant.',
            'price' => 8.99,
            'image_url' => 'https://example.com/aloe-vera.jpg',
            'slug' => 'aloe-vera',
            'category_id' => $category2->id,
        ]);
    }
}
