<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
//     // $token = $request->user()->createToken($request->token_name);
//     // return ['token' => $token->plainTextToken];
// })->middleware('auth:sanctum');
// Route::post('/user/ResetPassword',[AuthController::class,'reset_password']);

Route::post('/user/register',[AuthController::class,'register']);
Route::post('/user/login',[AuthController::class,'login']);

Route::group(['middleware'=> ['auth:sanctum']], function () {
    Route::post('/user/logout',[AuthController::class,'logout']);
    Route::post('/user/delete',[AuthController::class,'delete']);
    Route::post('/user/update',[AuthController::class,'update']);
});
