<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/brands', [BrandController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/search/{keyword}', [ProductController::class, 'search']);
Route::get('/products/category/{name}', [ProductController::class, 'filterByCategory']);
Route::get('/products/brand/{name}', [ProductController::class, 'filterByBrand']);
Route::get('/products/price/{rang}', [ProductController::class, 'filterByPrice']);
Route::get('/products/rating/{rating}', [ProductController::class, 'filterByRating']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::apiResource('cart',CartController::class)->middleware('auth:sanctum');