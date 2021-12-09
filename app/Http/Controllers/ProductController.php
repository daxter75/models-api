<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

    class ProductController extends Controller
{
    public function index()
    {
        $products = request()->user()->products;
        return response(ProductResource::collection($products));
    }

    public function show(Product $product)
    {
        if (request()->user()->isNot($product->user)) {
            return response(
                [
                    'message' => 'Not found'
                ],
                Response::HTTP_NOT_FOUND);
        }
        return response($product);
    }

    public function store(ProductRequest $request)
    {
        $res = request()->user()->products()->create($request->all());
        return response($res, Response::HTTP_CREATED);
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

    public function search($name)
    {
        return Product::where('name', 'like', '%' . $name . '%')->get();
    }
}
