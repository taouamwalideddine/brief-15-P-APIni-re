<?php
namespace Tests\Feature;

use App\Models\Plant;

class PlantTest extends \Tests\TestCase
{
    public function test_anyone_can_view_plants()
    {
        Plant::create(['name' => 'Basil', 'slug' => 'basil', 'price' => 5.99]);

        $response = $this->getJson('/api/plants');

        $response->assertStatus(200);
    }
}
