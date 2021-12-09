<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    private $product;

    public function setUp() : void
    {
        parent::setUp();
        $this->product = $this->createProduct(['brand_id' => 1, 'name' => 'my product', 'user_id' => 1]);
    }

    public function test_fetch_all_products()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);
        $response = $this->getJson(route('products.index'));

        $this->assertCount(1, $response->json());
        $this->assertEquals($this->product['name'], $response->json(0)['name']);
    }

    public function test_fetch_single_product()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);
        $response = $this->getJson(route('products.show', $this->product->id))->assertOk()->json();

        $this->assertEquals($this->product->name, $response['name']);
    }

    public function test_store_new_product()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);

        $response = $this
            ->postJson(route('products.store'), [
                'brand_id' => $this->product->brand_id,
                'name' => $this->product->name,
                'product_no' => $this->product->product_no,
                'scale' => $this->product->scale,
                'age' => $this->product->age,
                'level' => $this->product->level,
                'no_parts' => $this->product->no_parts,
                'length' => $this->product->length,
                'width' => $this->product->width,
                'height' => $this->product->height,
                'wingspan' => $this->product->wingspan,
                'url' => $this->product->url,
                'purchased_at' => $this->product->purchased_at,
                'finished_at' => $this->product->finished_at,
                'user_id' => $this->product->user_id
            ])
            ->assertCreated()
            ->json();

        $this->assertEquals($this->product->name, $response['name']);
        $this->assertDatabaseHas('products', ['name' => $this->product->name]);
    }

    public function test_while_storing_product_name_field_is_required()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);
        $this->withExceptionHandling();
        $this->postJson(route('products.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'user_id', 'brand_id']);
    }

    public function test_delete_product()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);
        $this->deleteJson(route('products.destroy', $this->product->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('products', ['name' => $this->product->name]);
    }

    public function test_update_product()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);
        $this->
            patchJson(
                route('products.update', $this->product->id),
                [
                    'name' => 'updated name',
                    'brand_id' => $this->product->brand_id,
                    'user_id' => $this->product->user_id
                ])
                ->assertOk();

        $this->assertDatabaseHas('products', ['id' => $this->product->id, 'name' => 'updated name']);
    }

    public function test_while_updating_product_name_field_is_required()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);
        $this->withExceptionHandling();
        $this->patchJson(route('products.update', $this->product->id))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }
}
