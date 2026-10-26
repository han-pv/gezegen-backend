<?php

use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\PingController;
use App\Http\Controllers\Api\V1\RoomController;
use Illuminate\Support\Facades\Route;

// http://127.0.0.1:8000/api/ping

Route::get('/ping', [PingController::class, 'hello']);

Route::get('/hotels/{hotel}/hotellerin-roomy', [RoomController::class, 'forHotel']);

Route::apiResource('hotels', HotelController::class);
Route::apiResource('cities', CityController::class);
Route::apiResource('rooms', RoomController::class);
