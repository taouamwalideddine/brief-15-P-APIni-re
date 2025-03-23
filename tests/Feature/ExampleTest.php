<?php


namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Plant;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlantTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_plant()
    {
        $category = Category::factory()->create();

        $response = $this->postJson('/api/admin/plants', [
            'name' => 'Test Plant',
            'description' => 'Test Description',
            'price' => 10.99,
            'slug' => 'test-plant',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['message', 'plant']);
    }

    public function test_update_plant()
    {
        $plant = Plant::factory()->create();

        $response = $this->putJson('/api/admin/plants/' . $plant->id, [
            'name' => 'Updated Plant',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Plant updated']);
    }

    public function test_delete_plant()
    {
        $plant = Plant::factory()->create();

        $response = $this->deleteJson('/api/admin/plants/' . $plant->id);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Plant deleted']);
    }
}
