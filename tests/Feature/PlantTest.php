<?php

namespace Tests\Feature;

use App\Models\Plant;

class PlantTest extends \Tests\TestCase
{
    public function test_anyone_can_view_plants()
    {
        Plant::create([
            'name' => 'Basil',
            'slug' => 'basil',
            'price' => 5.99
        ]);

        $response = $this->getJson('/api/plants');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Basil']);
    }

    public function test_anyone_can_view_plant_details()
    {
        Plant::create([
            'name' => 'Mint',
            'slug' => 'mint',
            'price' => 4.99
        ]);

        $response = $this->getJson('/api/plants/mint');

        $response->assertStatus(200)
            ->assertJson(['data' => ['slug' => 'mint']]);
    }
}
