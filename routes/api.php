<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products',\App\Http\Controllers\Api\ProductController::class);
Route::apiResource('sizes',\App\Http\Controllers\Api\SizeController::class);
Route::apiResource('marks',\App\Http\Controllers\Api\MarkController::class);
