<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response($product, Response::HTTP_CREATED);
    }
}
