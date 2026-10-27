<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ticket\FlightResource;
use App\Models\Ticket\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::with(['fromAirport', 'toAirport']);

        // Nirden (Haýsy aeroportdan)
        if ($request->has('from_airport_id') && $request->from_airport_id) {
            $query->where('from_airport_id', $request->from_airport_id);
        }

        // Nira (Haýsy aeroporta)
        if ($request->has('to_airport_id') && $request->to_airport_id) {
            $query->where('to_airport_id', $request->to_airport_id);
        }

        // Sene boýunça gözleg (Kalendar)
        if ($request->has('date') && $request->date) {
            $query->whereDate('departure_time', $request->date);
        }

        return FlightResource::collection($query->get());
    }

    public function show($id)
    {
        $flight = Flight::with(['fromAirport', 'toAirport'])->findOrFail($id);
        return new FlightResource($flight);
    }
}