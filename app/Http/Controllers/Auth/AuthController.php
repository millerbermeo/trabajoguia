<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) 
    
    {
        try {
            $request -> validate([
                'name'=> 'required|string',
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            $user = User::create([
                'name' => $request -> name,
                'email' => $request ->email,
                'password' => bcrypt($request -> password),
                'role' => 2 
            ]);

            $response = [
                'name'=> $user->name,
                'email'=> $user->email,
                'role' => 'USER'
            ];

            return response()->json($response, 201);


        } catch (\Exception $e) {
            return response($e);
        }
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "message"=> "usuario invalid"
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        

        return response()->json([
            'role'=> $user->role,
            'token'=> $token
        ], 200);
    }


    public function logout()

    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message'=> 'logout succes'
        ], 200);
    }
}
