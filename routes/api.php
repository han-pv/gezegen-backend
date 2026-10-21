<?php

use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\PingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// http://127.0.0.1:8000/api/ping

// Route::get('/ping', fn () => ['message' => 'pong']);

Route::get('/ping', [PingController::class, 'hello']);

Route::get('/hotels', [HotelController::class, 'index']);

Route::get('/cities', [CityController::class, 'index']);

Route::get('/cities/{city}', [CityController::class, 'show']);
