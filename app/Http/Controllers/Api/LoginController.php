<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials'
            ]);
        }

        $user = User::where('email', $request->email)->first();

        $token = JWTAuth::fromUser($user);

        return response()->json([
        'token' => $token,
            'user' => $user
        ]);
    }
    public function logout()
    {
        Auth::logout();

        return response()->json([
        'message' => 'Successfully logged out'
        ]);
    }
}
