<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'brand_id',
        'category_id',
        'salers_id',
        'stock',
        'discont',
        'delivery_time'
    ];

    function saler() {
        return $this->belongsTo(Saler::class);
    }
    function brand() {
        return $this->belongsTo(Brand::class);
    }
    function category() {
        return $this->belongsTo(Category::class);
    }
    function reviews() {
        return $this->hasMany(Review::class);
    }
    function images() {
        return $this->hasMany(Image::class);
    }
}
