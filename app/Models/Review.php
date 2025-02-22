<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        'is_approved',
        'title'
    ];

    protected $hidden = [
        'id',
        'product_id',
        "user_id",
        'updated_at'
    ];

    function writer() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
