<?php

namespace Tests\Unit;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_belongs_to_a_brand()
    {
        $this->withExceptionHandling();
        $brand = $this->createBrand();
        $product = $this->createProduct(['brand_id' => $brand->id]);

        $this->assertInstanceOf(Brand::class, $product->brand);
    }
}
