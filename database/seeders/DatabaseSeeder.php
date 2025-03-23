<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\CategoriesTableSeeder as SeedersCategoriesTableSeeder;
use Database\Seeders\PlantsTableSeeder as SeedersPlantsTableSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PlantsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            SeedersCategoriesTableSeeder::class,
            SeedersPlantsTableSeeder::class,
        ]);
    }
}
