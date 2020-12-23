<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\GoogleAuthController;
use App\Http\ontrollers\API\Auth\AppleAuthController;

use App\Http\Controllers\API\CEOController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('/ceo', 'App\Http\Controllers\API\CEOController')->middleware('auth:api');

Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle']);

Route::get('callback/google', [GoogleAuthController::class, 'handleCallback']);

Route::get('auth/apple', [AppleAuthController::class, 'redirectToApple']);

Route::get('callback/apple', [AppleAuthController::class, 'handleCallback']);