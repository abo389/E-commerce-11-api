<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;

    function index() {
        $categories = Category::with('sub_categories')->get();
        return $this->success('all categories',$categories);
    }
}
