<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response($products);
    }

    public function show(Product $product)
    {
        return response($product);
    }

    public function store(ProductRequest $request)
    {
        return response(Product::create($request->all()), Response::HTTP_CREATED);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return response($product);
    }
}
