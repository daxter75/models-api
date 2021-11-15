<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    private $product;

    public function setUp() : void
    {
        parent::setUp();
        $this->product = Product::factory()->create();
    }

    public function test_fetch_all_products()
    {

        $response = $this->getJson(route('products.index'));

        $this->assertCount(1, $response->json());
        $this->assertEquals($this->product['name'], $response->json(0)['name']);
    }

    public function test_fetch_single_product()
    {
        $response = $this->getJson(route('products.show', $this->product->id))->assertOk()->json();

        $this->assertEquals($this->product->name, $response['name']);
    }

    public function test_store_new_product()
    {
        $product = Product::factory()->make();
        $response = $this->postJson(route('products.store'), ['name' => $product->name])->assertCreated()->json();

        $this->assertEquals($product->name, $response['name']);
        $this->assertDatabaseHas('products', ['name' => $product->name]);
    }
}
