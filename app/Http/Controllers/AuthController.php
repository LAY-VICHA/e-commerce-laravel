<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register( Request $request){
        $data = $request->validate([
            'username' => 'required|unique:users',
            "firstname" => 'string',
            "lastname" => 'string',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'in:admin,customer',
        ]);

        // Set default role to 'customer' if not provided in the request
        $userData = array_merge($data, ['role' => $data['role'] ?? 'customer']);


        // Mass assign the validated request data to a new instance of the User model
        $user = User::create($userData);
        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'Type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'Type' => 'Bearer',
            'role' => $user->role // include user role in response
        ]);
    }

    public function logout(Request $request) {
        // auth()->user()->tokens->delete();
        // auth()->user()->token()->revoke();
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function checkValidRegister(Request $request) {
        $username = User::where('username', $request['username'])->first();
        if($username) {
            return response([
                'message' => 'Username is alredy taken'
            ]);
        }
        
        $user = User::where('email', $request['email'])->first();
        if($user) {
            return response([
                'message' => 'Email is alredy taken'
            ]);
        }

        return null;
    }
}
