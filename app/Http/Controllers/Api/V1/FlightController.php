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
        $request->validate([
            'from' => 'nullable|integer|exists:airports,id',
            'to' => 'nullable|integer|exists:airports,id',
            'date' => 'nullable|date',
        ]);

        $query = Flight::query()->with('fromAirport', 'toAirport');

        if ($request->filled('from')) {
            $query->where('from_airport_id', $request->from);
        }

        if ($request->filled('to')) {
            $query->where('to_airport_id', $request->to);
        }

        if ($request->filled('date')) {
            $query->whereDate('departure_at', $request->date);
        }

        return FlightResource::collection($query->orderBy('departure_at')->get());
    }

    public function show(Flight $flight)
    {
        return new FlightResource($flight->load('fromAirport', 'toAirport'));
    }
}