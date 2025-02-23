<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    function user() {
        $user = auth('sanctum')->user();
        // i want to get the user's reviews
        $user->reviews;
        return $this->success('user',$user);
    }

    function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create($validatedData);

        $token = $user->createToken($user->name.'_token')->plainTextToken;

        return $this->success('user created successfully',[
            'user' => $user,
            'token' => $token
        ]);
    }

    function login(Request $request) {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error('the provided credentials are incorrect');
        }
        $token = $user->createToken($user->name.'_token')->plainTextToken;
        return $this->success('user logged in successfully',[
            'user' => $user,
            'token' => $token
        ]);
    }

    function logout() {
        auth('sanctum')->user()->tokens()->delete();
        return $this->success('user logged out successfully');
    }
}