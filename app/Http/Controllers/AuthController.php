<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * Validates the incoming request data and then creates a new user in the database.
     * The function expects the request to contain 'name', 'email', and 'password'.
     * The email is checked to be unique in the 'users' table.
     *
     * @param  \Illuminate\Http\Request  $request The request object containing user registration data.
     * @return \Illuminate\Http\Response A response object indicating the result of the operation.
     * @throws \Illuminate\Validation\ValidationException If the validation fails.
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string:max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:10|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'The provided credentials are incorrect'
            ], 400);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'token_type' => 'Bearer',
            'access_token' => $token,
        ]);
    }
}
