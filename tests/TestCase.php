<?php

namespace Tests;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp() : void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function createProduct($args = [])
    {
        return Product::factory()->create($args);
    }

    public function createBrand($args = [])
    {
        return Brand::factory()->create($args);
    }
}
