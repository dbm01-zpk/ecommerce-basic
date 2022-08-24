<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::middleware('auth:api')->post('logout', [RegisterController::class, 'logout']);
Route::middleware('auth:api')->group(function () {
    Route::apiResource('products', ProductController::class)->only([
        'store',
        'edit',
        'update',
        'destroy',
    ]);
    Route::apiResource('users', UserController::class);
});

# Public
Route::apiResource('products', ProductController::class)->only([
    'show',
    'index',
]);
