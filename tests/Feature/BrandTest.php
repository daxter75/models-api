<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->brand = $this->createBrand(['name' => 'Revell']);
    }

    public function test_fetch_all_brands()
    {
        $response = $this->getJson(route('brands.index'));

        $this->assertCount(1, $response->json());
        $this->assertEquals($this->brand['name'], $response->json(0)['name']);
    }

    public function test_fetch_single_brand()
    {
        $response = $this->getJson(route('brands.show', $this->brand->id))->assertOk()->json();

        $this->assertEquals($this->brand->name, $response['name']);
    }

    public function test_store_new_brand()
    {
        $brand = Brand::factory()->make();
        $response = $this
            ->postJson(route('products.store'), [
                'name' => $brand->name,
                'url' => $brand->url,
                'purchased_at' => $brand->purchased_at,
                'finished_at' => $brand->finished_at,
                'author_id' => $brand->author_id,
            ])
            ->assertCreated()
            ->json();

        $this->assertEquals($brand->name, $response['name']);
        $this->assertDatabaseHas('brands', ['name' => $brand->name]);
    }

}
