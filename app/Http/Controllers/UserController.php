<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Create the user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate Sanctum token
        $token = $user->generateToken();

        return response()->json([
            'message' => 'User registered successfully',
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        $token = $user->generateToken();

        return response()->json([
            'message' => 'Login successful',
            'user' => new UserResource($user),
            'token' => $token,
        ],200);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json([
            'message' => 'Logged out successfully',
            'status' => 200
        ]);
    }

    public function getUser(Request $request)
    {
        $user = Auth::user();

        return new UserResource($user);
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 403);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return response()->json(['message' => 'Password updated successfully']);
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        $user->delete();
        $user->tokens()->delete();

        return response()->json(['message' => 'Account deleted successfully']);
    }
}
