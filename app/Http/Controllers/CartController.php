<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ApiResponse;

    function index() {
        $cart = Cart::with('product')->where('user_id',auth('sanctum')->id())->get();
        if(count($cart) == 0) {
            return $this->success('cart is empty');
        }
        // i want to get the product images
        foreach ($cart as $k => $item) {
            $cart[$k]['product']['images'] = $item->product->images()->pluck('link');
        }
        return $this->success('cart',$cart);
    }

    function store(Request $request) {

        $n = Cart::where('user_id', auth('sanctum')->id())
        ->where('product_id', $request->product_id)
        ->count();

        if ($n > 0) {
            $cart = Cart::where('user_id', auth('sanctum')->id())
                ->where('product_id', $request->product_id)->first();
            $cart->increment('quantity');
        }
        else {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer',
            ]);
            $cart = Cart::create([
                'user_id' => auth('sanctum')->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }
        
        return $this->success('added to cart successfully',$cart);
    }

    function update(Request $request) {
        $product_id = $request['cart'];
        $request->validate([
            'quantity' =>'required|integer',
        ]);
        $cart = Cart::where('user_id', auth('sanctum')->id())
        ->where('product_id',$product_id)->first();
        if(!$cart) {
            return $this->error('there is no product with id ' . $product_id . ' exist in cart');
        }
        $cart->update([
            'quantity' => $request->quantity,
        ]);
        return $this->success('cart updated successfully',$cart);
    }

    function destroy(Request $request) {
        $product_id = $request['cart'];
        $cart = Cart::where('user_id', auth('sanctum')->id())
        ->where('product_id',$product_id)->first();
        if(!$cart) {
            return $this->error('there is no product with id '.$product_id. ' exist in cart');
        }
        $cart->delete();
        return $this->success('cart deleted successfully');
    }
}
