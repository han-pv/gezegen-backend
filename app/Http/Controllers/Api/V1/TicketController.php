<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket\Flight;
use App\Models\Ticket\Passenger;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['flight.fromAirport', 'flight.toAirport', 'passenger'])->get();
        return TicketResource::collection($tickets);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'seat_number' => 'nullable|string',
        ]);

        $passenger = Passenger::firstOrCreate(
            ['email' => $validated['email']],
            ['full_name' => $validated['full_name'], 'phone' => $validated['phone']]
        );

        $flight = Flight::findOrFail($validated['flight_id']);

        $ticket = Ticket::create([
            'flight_id' => $flight->id,
            'passenger_id' => $passenger->id,
            'seat_number' => $validated['seat_number'] ?? rand(1, 30) . 'A',
            'price' => $flight->price,
        ]);

        if ($flight->empty_seats > 0) {
            $flight->decrement('empty_seats');
        }

        return new TicketResource($ticket->load(['flight.fromAirport', 'flight.toAirport', 'passenger']));
    }
}
