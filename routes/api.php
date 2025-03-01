<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\OrderController;
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
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::get('/credit_cards', [CreditCardController::class, 'index'])->middleware('auth:sanctum');
Route::post('/credit_cards', [CreditCardController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/credit_cards/{id}', [CreditCardController::class,'destroy'])->middleware('auth:sanctum');
Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->middleware('auth:sanctum');
Route::post('/add-coupon', [CouponController::class, 'addCoupon'])->middleware('auth:sanctum');