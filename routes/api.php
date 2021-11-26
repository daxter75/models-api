<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::patch('products/{product}', [ProductController::class, 'update'])->name('products.update');
