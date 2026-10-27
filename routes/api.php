<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\RoomController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\AirplaneController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/v1/cities', [CityController::class, 'index']);
Route::get('/v1/cities/{id}', [CityController::class, 'show']);
Route::post('/v1/cities', [CityController::class, 'store']);
Route::put('/v1/cities/{id}', [CityController::class, 'update']);
Route::delete('/v1/cities/{id}', [CityController::class, 'destroy']);

Route::get('/v1/hotels', [HotelController::class, 'index']);
Route::get('/v1/hotels/{id}', [HotelController::class, 'show']);
Route::post('/v1/hotels', [HotelController::class, 'store']);
Route::put('/v1/hotels/{id}', [HotelController::class, 'update']);
Route::delete('/v1/hotels/{id}', [HotelController::class, 'destroy']);
Route::get('/hotels/{hotel}/rooms', [HotelController::class, 'rooms']);

Route::get('/v1/rooms', [RoomController::class, 'index']);
Route::get('/v1/rooms/{room}', [RoomController::class, 'show']);


Route::prefix('v1')->group(function () {
    Route::get('flights/locations', [FlightController::class, 'locations']);
    Route::get('flights', [FlightController::class, 'index']);
    Route::get('flights/{id}', [FlightController::class, 'show']);
    Route::post('flights', [FlightController::class, 'store']);

    Route::post('tickets/quote', [TicketController::class, 'quote']);
    Route::post('tickets', [TicketController::class, 'store']);
    Route::get('tickets/{code}', [TicketController::class, 'show']);

    Route::get('airplanes', [AirplaneController::class, 'index']);
    Route::get('airplanes/{id}', [AirplaneController::class, 'show']);
    Route::post('airplanes', [AirplaneController::class, 'store']);
});