<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    use ApiResponse;

    public function applyCoupon(Request $request) {
        $request->validate([
            'code' =>'required|string|exists:coupons,code',
        ]);
        $coupon = Coupon::where('code',$request->code)->first();
        $total = Cart::with('product')->where('user_id', auth('sanctum')->id())->get()
        ->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        if($coupon->expiration_date < now()) {
            return $this->error('coupon expired');
        }
        if($coupon->type == 'fixed') {
            $total -= $coupon->discount;
        }
        if($coupon->type == 'percentage') {
            $total -= $total * $coupon->discount / 100;
        }
        if ($total < 0) {
            return $this->error('coupon discount is greater than total price');
        }
        return $this->success('coupon applied successfully!', [
            'total' => round($total,2)
        ]);
    }

    public function addCoupon(Request $request) {
        $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'expiration_date' => 'date|after:now',
            'type' => 'string|in:fixed,percentage',
            'discount' => [
                'required',
                'integer',
                Rule::when($request->type === 'percentage', ['between:1,100']),
                Rule::when($request->type === 'fixed', ['between:1,10000']),
            ],
        ]);
        $coupon = Coupon::create([
            'code' => $request->code,
            'discount' => $request->discount,
            'expiration_date' => $request->expiration_date,
            'type' => $request->type,
        ]);

        return $this->success('coupon added successfully!',$coupon);
    }
}
