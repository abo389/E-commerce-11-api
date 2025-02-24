<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /** @use HasFactory<\Database\Factories\SubCategoryFactory> */
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'image'];

    function products() {
        return $this->hasManyThrough(Product::class, Category::class);
    }
}
