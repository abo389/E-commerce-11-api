<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;

    function index() {
        $categories = Category::with('sub_categories')->get();
        $data = [ ];
        foreach ($categories as $k => $category) {
            $data[$k]["id"] = 'category_'.$category->id;
            $data[$k]["name"] = $category->name;
            $data[$k]["sub_categories"] = $category->sub_categories()->select('name', 'image')->get();
        }
        if (!$categories) {
            return $this->error('no categories found', 404);
        }
        return $this->success('all categories',$data);
    }
}
