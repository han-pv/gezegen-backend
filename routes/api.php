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

    // 1. Airports (Aeroportlar)
    Route::get('/airports', [AirportController::class, 'index']);
    Route::get('/airports/{id}', [AirportController::class, 'show']); // Parametrli route

    // 2. Flights (Uçuşlar - Filtrler we Parametrler bilen)
    // Mysal üçin: /api/v1/flights?from_airport_id=1&to_airport_id=2&date=2026-10-30
    Route::get('/flights', [FlightController::class, 'index']);
    Route::get('/flights/{id}', [FlightController::class, 'show']); // Parametrli route ({id})

    // 3. Passengers (Ýolagçylar)
    Route::get('/passengers', [PassengerController::class, 'index']);
    Route::get('/passengers/{id}', [PassengerController::class, 'show']); // Parametrli route ({id})

    // 4. Tickets (Biletler - Gözleg, Döretmek we ID boýunça görmek)
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::post('/tickets', [TicketController::class, 'store']);       // Bilet satyn almak
    Route::get('/tickets/{id}', [TicketController::class, 'show']);   // Parametrli route ({id})

});
