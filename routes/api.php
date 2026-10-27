<?php

use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\PassengerController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\AirportController;
use Illuminate\Support\Facades\Route;

// // http://127.0.0.1:8000/api/ping

// Route::get('/ping', [PingController::class, 'hello']);

// // Route::apiResource('hotels', HotelController::class);
// // Route::get('/hotels', [HotelController::class, 'index']);
// // Route::get('/hotels/{hotel}', [HotelController::class, 'show']);
// // Route::post('/hotels', [HotelController::class, 'store']);
// // Route::put('/hotels/{hotel}', [HotelController::class, 'update']);
// // Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy']);
// // Route::get('/hotels/{hotel}/hotellerin-roomy', [RoomController::class, 'forHotel']);

// // Route::apiResource('cities', CityController::class);
// // Route::apiResource('rooms', RoomController::class);

Route::prefix('v1')->group(function () {
    // Route::get('/airports', [AirportController::class, 'index']);
    // Route::get('/rooms/{ room }', [RoomController::class, 'show']);
    // Route::get('/hotels/{ hotel }/rooms', [RoomController::class, 'hotelRooms']);
    Route::apiResource('/cities', CityController::class);
    Route::apiResource('/airports', AirportController::class);
    Route::apiResource('/flights', FlightController::class);
    Route::apiResource('/passengers', PassengerController::class);
    Route::apiResource('/tickets', TicketController::class);
    Route::post('/tickets/{ticket}/book', [TicketController::class, 'book']);
});
