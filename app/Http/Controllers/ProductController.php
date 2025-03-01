<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  use ApiResponse;

  private function filterProducts($products) {
    $data = [];
    foreach ($products as $k => $product) {
      $data[$k]["id"] = $product->id;
      $data[$k]["name"] = $product->name;
      $data[$k]["price"] = $product->price;
      $data[$k]["discount"] = $product->discount;
      $data[$k]["delivery_time"] = $product->delivery_time;
      $data[$k]["category"] = $product->category->name;
      $data[$k]["brand"] = $product->brand->name;
      $data[$k]["reviews_count"] = $product->reviews()->count();
      $data[$k]["reviews_avg"] = round($product->reviews()->selectRaw('avg(cast(rating as float)) as average_rating')->value('average_rating'), 1);
      $data[$k]["images"] = $product->images->pluck('link');
    }
    return $data;
  }

  function index() {
    $products = Product::with('category', 'brand','reviews', 'images')->paginate(10);

    $data = $this->filterProducts($products);

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
  
  function search($keyword) {

    $products = Product::where('name', 'like', '%' . $keyword . '%')->with('reviews', 'images')->paginate(10);

    $data = $this->filterProducts($products);

    if (!$products) {
      return $this->error('no products found', 404);
    }

    return $this->success('all products', $data);
  }

  function filterByCategory($name) {
    $products = Product::with('category', 'brand', 'reviews', 'images')
    ->whereHas('category', function($query) use ($name) {
      $query->where('name', $name);
    })->get();

    $data = $this->filterProducts($products);

    return $this->success('all products related to '.$name, $data);
  }

  function filterByBrand($name) {
    $products = Product::with('brand', 'category', 'reviews', 'images')
    ->whereHas('brand', function($query) use ($name) {
      $query->where('name', $name);
    })->get();

    $data = $this->filterProducts($products);

    return $this->success('all products related to '.$name, $data);
  }

  function filterByPrice($rang) {
    $products = Product::with('reviews', 'images', 'brand', 'category')
    ->whereBetween('price', explode('-', $rang))->get();
    $data = $this->filterProducts($products);
    return $this->success('all products where is price between rang', $data);
  }

  function filterByRating($rate) {
    $products = Product::with('reviews', 'images', 'brand', 'category')->get();
    $data = [];
    foreach ($products as $k => $product) {
      if (round($product->reviews()->selectRaw('avg(cast(rating as float)) as average_rating')->value('average_rating'), 1) < $rate) {
        continue;
      }
      $data[$k]["id"] = $product->id;
      $data[$k]["name"] = $product->name;
      $data[$k]["price"] = $product->price;
      $data[$k]["discount"] = $product->discount;
      $data[$k]["delivery_time"] = $product->delivery_time;
      $data[$k]["category"] = $product->category->name;
      $data[$k]["brand"] = $product->brand->name;
      $data[$k]["reviews_count"] = $product->reviews()->count();
      $data[$k]["reviews_avg"] = round($product->reviews()
      ->selectRaw('avg(cast(rating as float)) as average_rating')
      ->value('average_rating'), 1);
      $data[$k]["images"] = $product->images->pluck('link');
    }
    return $this->success('All products where the average rating is greater than or equal to ' . $rate, $data);
  }
}
