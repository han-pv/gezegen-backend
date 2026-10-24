<?php

use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\PingController;
use App\Http\Controllers\Api\V1\RoomController;
use App\Http\Controllers\Api\V1\AirportController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\PassengerController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', [PingController::class, 'hello']);

Route::prefix('v1')->group(function () {

    Route::get('/hotels', [HotelController::class, 'index']);
    Route::get('/hotels/{hotel}', [HotelController::class, 'show']);
    Route::post('/hotels', [HotelController::class, 'store']);
    Route::put('/hotels/{hotel}', [HotelController::class, 'update']);
    Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy']);
    Route::get('/hotels/{hotel}/hotellerin-roomy', [RoomController::class, 'forHotel']);

    Route::apiResource('cities', CityController::class);
    Route::apiResource('rooms', RoomController::class);


    Route::apiResource('airports', AirportController::class);
    Route::apiResource('flights', FlightController::class);
    Route::apiResource('tickets', TicketController::class);
    Route::apiResource('passengers', PassengerController::class);
});
