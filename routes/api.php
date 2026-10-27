<?php

use App\Http\Controllers\Api\V1\AirportController;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\RoomController;
use App\Http\Controllers\Api\V1\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/hotels/{hotel}/hotellerin-roomy', [RoomController::class, 'forHotel']);
    Route::apiResource('hotels', HotelController::class);
    Route::apiResource('cities', CityController::class);
    Route::apiResource('rooms', RoomController::class);

    Route::apiResource('airports', AirportController::class)->only(['index', 'show']);
    Route::apiResource('flights', FlightController::class)->only(['index', 'show']);
    Route::apiResource('tickets', TicketController::class);
});