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
        $this->product = $this->createProduct(['name' => 'my product']);
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
        $response = $this
            ->postJson(route('products.store'), [
                'brand_id' => $product->brand_id,
                'name' => $product->name,
                'product_no' => $product->product_no,
                'scale' => $product->scale,
                'age' => $product->age,
                'level' => $product->level,
                'no_parts' => $product->no_parts,
                'length' => $product->length,
                'width' => $product->width,
                'height' => $product->height,
                'wingspan' => $product->wingspan,
                'url' => $product->url,
                'purchased_at' => $product->purchased_at,
                'finished_at' => $product->finished_at,
                'author_id' => $product->author_id,
            ])
            ->assertCreated()
            ->json();

        $this->assertEquals($product->name, $response['name']);
        $this->assertDatabaseHas('products', ['name' => $product->name]);
    }

    public function test_while_storing_product_name_field_is_required()
    {
        $this->withExceptionHandling();
        $this->postJson(route('products.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }

    public function test_delete_product()
    {
        $this->deleteJson(route('products.destroy', $this->product->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('products', ['name' => $this->product->name]);
    }

    public function test_update_product()
    {
        $this->patchJson(route('products.update', $this->product->id), ['name' => 'updated name'])
            ->assertOk();

        $this->assertDatabaseHas('products', ['id' => $this->product->id, 'name' => 'updated name']);
    }

    public function test_while_updating_product_name_field_is_required()
    {
        $this->withExceptionHandling();
        $this->patchJson(route('products.update', $this->product->id))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }
}
