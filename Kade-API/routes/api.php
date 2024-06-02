<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
//     // $token = $request->user()->createToken($request->token_name);
//     // return ['token' => $token->plainTextToken];
// })->middleware('auth:sanctum');

Route::post('/user/regster',[AuthController::class,'register']);
Route::post('/user/login',[AuthController::class,'login']);

