<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    protected $brand;

    public function setUp(): void
    {
        parent::setUp();
        $this->brand = $this->createBrand(['name' => 'Revell', 'user_id' => 1]);
    }

    public function test_fetch_all_brands()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);

        $response = $this->get(route('brands.index'));

        $this->assertCount(1, $response->json());
        $this->assertEquals($this->brand['name'], $response->json(0)['name']);
    }

    public function test_fetch_single_brand()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);

        $response = $this->getJson(route('brands.show', $this->brand->id))->assertOk()->json();

        $this->assertEquals($this->brand->name, $response['name']);
    }

    public function test_store_new_brand()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);

        $brand = Brand::factory()->make();

        $response = $this
            ->postJson(route('brands.store'), [
                'name' => $brand->name,
                'url' => $brand->url,
                'user_id' => $brand->user_id,
            ])
            ->assertCreated()
            ->json();

        $this->assertEquals($brand->name, $response['name']);
        $this->assertDatabaseHas('brands', ['name' => $brand->name]);
    }

}
