<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CreditCardController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $cards = CreditCard::all()->where('user_id', auth('sanctum')->id());
        if(count($cards) == 0) {
            return $this->success('no credit_cards found for this user');
        }
        return $this->success('all credit_cards' ,$cards);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cardholder_name' => 'required|string|max:255',
            'card_number' => 'required|string|size:16',
            'expiration_date' => 'required|date_format:Y-m|date|after:today',
            'cvv' => 'required|numeric|min:3',
        ]);
        $cardNumber = (string) $request->card_number;
        $exists = \App\Models\CreditCard::where('card_number', $cardNumber)->exists();
        if ($exists) {
            return $this->error('credit_card already exists', 409);
        }

        $card = CreditCard::create([
            'user_id' => auth('sanctum')->id(),
            'cardholder_name' => $request->cardholder_name,
            'card_number' => $request->card_number,
            'expiration_date' => $request->expiration_date,
            'cvv' => $request->cvv,
        ]);
        return $this->success('credit_card created',$card);
    }
}
