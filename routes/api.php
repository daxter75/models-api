<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// public routes
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('brands', BrandController::class);

    Route::apiResource('products', ProductController::class);
    Route::get('products/search/{name}', [ProductController::class, 'search']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
