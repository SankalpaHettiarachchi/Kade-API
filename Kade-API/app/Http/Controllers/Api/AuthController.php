<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserUpdateRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->Validated($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address'=> $request->address,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken($user->id);
        return response()->json([
            'token'=> $token,
            'id'=> $user->id,
            'name'=> $user->name,
            'email'=> $user->email,
            'address'=> $user->address,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $request->Validated($request->all());
        if(!Auth::attempt($request->only(['email','password']))) {
            return response()->json(['message' => 'Unauthorized'],401);
        }
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        return response()->json([
            'message'=> 'User found',
            'token'=>$token,
            'user'=> $user,
        ],200);
    }

    public function update(UserUpdateRequest $request)
    {
        $request->Validated($request->all());
        $id = Auth::user()->id;
        $user = DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'address'=> $request->address,
                    'password' => Hash::make($request->password),
                ]);
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        return response()->json([
            'message' => 'User update successfully',
            'token' => $token,
            'user' => $user,
        ],200);
    }

    public function logout(Request $request){
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ],204);
    }

    public function delete(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->delete();

        if ($user->delete()) {
            return response()->json([
                'accessToken' =>'This account deleted !'
            ],204);
        }
    }
}
