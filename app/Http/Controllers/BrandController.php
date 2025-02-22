<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Traits\ApiResponse;

class BrandController extends Controller
{
    use ApiResponse;

    function index() {
        $brands = Brand::all();
        return $this->success('all brands' ,$brands);
    }
}