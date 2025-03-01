<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    /** @use HasFactory<\Database\Factories\CreditCardFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cardholder_name',
        'card_number',
        'expiration_date',
        'cvv',
    ];
}
