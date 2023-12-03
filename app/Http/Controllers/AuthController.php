<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request):JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json(['token' => $token, 'user' => new UserResource($user)]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function register(RegisterRequest $request):JsonResponse
    {
        $existingUser = User::where('email', $request->input('email'))->first();

        if ($existingUser) {
            return response()->json(['error' => 'User already registered'], 422);
        }

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone_number' => $request->input('phone_number'),
        ]);

        // You can choose not to return a token for registration
        return response()->json(['message' => 'Registration successful', 'user' => new UserResource($user)]);
    }
}
