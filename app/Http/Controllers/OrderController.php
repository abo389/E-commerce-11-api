<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $orders = Order::all()->where('user_id', auth('sanctum')->id());
        if(count($orders) == 0) {
            return $this->success('no orders found for this user');
        }
        return $this->success('all orders',$orders);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'total_price' => 'required|integer',
            'payment_method' => 'required|in:credit_card,cash,buy_now_pay_later',
        ]);
        $order = Order::create([
            'user_id' => auth('sanctum')->id(),
            'cart_id' => $request->cart_id,
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method,
        ]);
        return $this->success('order created',$order);
    }

}
