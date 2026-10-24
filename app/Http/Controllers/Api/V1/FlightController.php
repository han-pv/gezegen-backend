<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreFlightRequest;
use App\Http\Requests\Api\V1\UpdateFlightRequest;
use App\Models\Flight;

class FlightController extends Controller
{
    public function index()
    {
        return response()->json(Flight::with(['departureAirport', 'arrivalAirport'])->get());
    }

    public function store(StoreFlightRequest $request)
    {
        $flight = Flight::create($request->validated());
        return response()->json($flight->load(['departureAirport', 'arrivalAirport']), 201);
    }

    public function show(string $id)
    {
        $flight = Flight::with(['departureAirport', 'arrivalAirport', 'tickets'])->findOrFail($id);
        return response()->json($flight);
    }

    public function update(UpdateFlightRequest $request, string $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->update($request->validated());
        return response()->json($flight->load(['departureAirport', 'arrivalAirport']));
    }

    public function destroy(string $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();
        return response()->json(['message' => 'Flight deleted successfully']);
    }
}
