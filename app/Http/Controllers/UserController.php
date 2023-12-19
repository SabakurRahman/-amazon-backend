<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|max:10'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password))
        {
            return response()->json([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function updateUserProfile(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . auth()->id(),
            'password' => 'string|min:6|confirmed',
            'password_confirmation' => 'string|min:6|max:10',
        ]);
        $user = auth()->user();
        $data=[
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
        ];
        if ($request->password)
        {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return response()->json([
            'message' => 'User profile updated successfully',
            'user' => $user,
        ], 200);
    }
}
