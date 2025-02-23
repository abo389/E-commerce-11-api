<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\ApiResponse;

class ProductController extends Controller
{
  use ApiResponse;

  function index()
  {
    $products = Product::with('reviews', 'images')->paginate(10);

    $data = [];
    foreach ($products as $k => $product) {
      $data[$k]["id"] = $product->id;
      $data[$k]["name"] = $product->name;
      $data[$k]["price"] = $product->price;
      $data[$k]["discount"] = $product->discount;
      $data[$k]["delivery_time"] = $product->delivery_time;
      $data[$k]["reviews_count"] = $product->reviews()->count();
      $data[$k]["reviews_avg"] = round($product->reviews()->selectRaw('avg(cast(rating as float)) as average_rating')->value('average_rating'), 1);
      $data[$k]["images"] = $product->images->pluck('link');
    }

    if (!$products) {
      return $this->error('no products found', 404);
    }

    return $this->success('all products', $data);
  }

  function show($id) {
    $product = Product::find($id);

    $data = [
      "id" => $product->id,
      "name" => $product->name,
      "description" => $product->description,
      "price" => $product->price,
      "stock" => $product->stock,
      "discount" => $product->discount,
      "delivery_time" => $product->delivery_time,
      "reviews_count" => $product->reviews()->count(),
      "reviews_avg" => round($product->reviews()->selectRaw('avg(cast(rating as float)) as average_rating')->value('average_rating'), 1),
      "saler" => $product->saler()->select('name', 'city')->first(),
      "category" => $product->category->name,
      "brand" => $product->brand->name,
      "images" => $product->images->pluck('link'),
      "reviews" => $product->reviews()->with('writer')->get()
    ];

    if (!$product) {
      return $this->error('product not found', 404);
    }
    return $this->success('product found', $data);
  }

  

  
}
