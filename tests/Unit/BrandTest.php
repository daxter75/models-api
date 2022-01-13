<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_brand_can_have_many_products()
    {
        $this->withExceptionHandling();
        $brand = $this->createBrand();
        $product = $this->createProduct(['brand_id' => $brand->id]);

        $this->assertInstanceOf(Product::class, $brand->products->first());
    }
}
