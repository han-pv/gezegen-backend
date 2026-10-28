<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FlightResource;
use App\Models\Ticket\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::with(['originAirport', 'destinationAirport']);

        if ($request->has('origin_id')) {
            $query->where('origin_airport_id', $request->origin_id);
        }

        if ($request->has('destination_id')) {
            $query->where('destination_airport_id', $request->destination_id);
        }

        return FlightResource::collection($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline' => 'required|string|max:255',
            'flight_number' => 'required|string|max:50',
            'origin_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'duration' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'empty_seats' => 'required|integer|min:0',
        ]);

        $flight = Flight::create($validated);

        return new FlightResource($flight->load(['originAirport', 'destinationAirport']));
    }

    public function show(Flight $flight)
    {
        return new FlightResource($flight->load(['originAirport', 'destinationAirport']));
    }

    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'airline' => 'sometimes|required|string|max:255',
            'flight_number' => 'sometimes|required|string|max:50',
            'origin_airport_id' => 'sometimes|required|exists:airports,id',
            'destination_airport_id' => 'sometimes|required|exists:airports,id',
            'departure_time' => 'sometimes|required|date',
            'arrival_time' => 'sometimes|required|date|after:departure_time',
            'duration' => 'nullable|string|max:50',
            'price' => 'sometimes|required|numeric|min:0',
            'empty_seats' => 'sometimes|required|integer|min:0',
        ]);

        $flight->update($validated);

        return new FlightResource($flight->load(['originAirport', 'destinationAirport']));
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return response()->json(null, 204);
    }
}
