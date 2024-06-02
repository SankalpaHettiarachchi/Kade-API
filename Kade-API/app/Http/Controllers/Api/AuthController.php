<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->Validated($request->all());
        try {
            // Create the new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address'=> $request->address,
                'password' => Hash::make($request->password),
            ]);
            // Generate a token for the newly created user
            $token = $user->createToken($user->id);
            return response()->json(['token' => $token->plainTextToken],201);

        }catch (Exception $e) {
            return response()->json(['error' => 'Email already exists !'],403);
        }
    }

    public function login(LoginRequest $request)
    {
        $request->Validated($request->all());
        
        if(!Auth::attempt($request->only(['email','password']))) {
            return response()->json(['message' => 'Unauthorized'],401);
        }
        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
        return response()->json(['accessToken' =>$token,'token_type' => 'Bearer',]);
    }
}
