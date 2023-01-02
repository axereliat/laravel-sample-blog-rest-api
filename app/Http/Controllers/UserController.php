<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:12']
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role_id'] = 2;

        $user = User::create($validated);

        $token = $user->createToken($user->email);

        return response()->json(['token' => $token->plainTextToken], 201);
    }

    public function authenticate(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken(Auth::user()->email);

            return response()->json(['token' => $token->plainTextToken], 201);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }
}
