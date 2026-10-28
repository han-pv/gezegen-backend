<?php

use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\PingController;
use App\Http\Controllers\Api\V1\RoomController;
use App\Http\Controllers\Api\V1\AirportController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\PassengerController;
use App\Http\Controllers\Api\V1\TicketController;
use Illuminate\Support\Facades\Route;

// http://127.0.0.1:8000/api/ping

Route::get('/ping', [PingController::class, 'hello']);

// Route::apiResource('hotels', HotelController::class);
Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/hotels/{hotel}', [HotelController::class, 'show']);
Route::post('/hotels', [HotelController::class, 'store']);
Route::put('/hotels/{hotel}', [HotelController::class, 'update']);
Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy']);
Route::get('/hotels/{hotel}/hotellerin-roomy', [RoomController::class, 'forHotel']);

Route::apiResource('cities', CityController::class);
Route::apiResource('rooms', RoomController::class);

Route::prefix('v1')->group(function () {

    Route::apiResource('airports', AirportController::class);
    Route::apiResource('flights', FlightController::class);
    Route::apiResource('passengers', PassengerController::class);
    Route::apiResource('tickets', TicketController::class);

    /*
    Route::get('airports', [AirportController::class, 'index']);
    Route::post('airports', [AirportController::class, 'store']);
    Route::get('airports/{airport}', [AirportController::class, 'show']);
    Route::put('airports/{airport}', [AirportController::class, 'update']);
    Route::delete('airports/{airport}', [AirportController::class, 'destroy']);

    Route::get('flights', [FlightController::class, 'index']);
    Route::post('flights', [FlightController::class, 'store']);
    Route::get('flights/{flight}', [FlightController::class, 'show']);
    Route::put('flights/{flight}', [FlightController::class, 'update']);
    Route::delete('flights/{flight}', [FlightController::class, 'destroy']);

    Route::get('passengers', [PassengerController::class, 'index']);
    Route::post('passengers', [PassengerController::class, 'store']);
    Route::get('passengers/{passenger}', [PassengerController::class, 'show']);
    Route::put('passengers/{passenger}', [PassengerController::class, 'update']);
    Route::delete('passengers/{passenger}', [PassengerController::class, 'destroy']);

    Route::get('tickets', [TicketController::class, 'index']);
    Route::post('tickets', [TicketController::class, 'store']);
    Route::get('tickets/{ticket}', [TicketController::class, 'show']);
    Route::put('tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy']);
    */

});
