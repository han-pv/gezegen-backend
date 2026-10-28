<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        return TicketResource::collection(Ticket::with(['flight.originAirport', 'flight.destinationAirport', 'passenger'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'passenger_id' => 'required|exists:passengers,id',
            'seat_number' => 'nullable|string|max:10',
            'passenger_count' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'sometimes|string|max:50',
        ]);

        $ticket = DB::transaction(function () use ($validated) {
            $flight = Flight::findOrFail($validated['flight_id']);
            $count = $validated['passenger_count'] ?? 1;

            if ($flight->empty_seats < $count) {
                abort(422, 'Not enough empty seats available on this flight.');
            }

            $flight->decrement('empty_seats', $count);

            return Ticket::create($validated);
        });

        return new TicketResource($ticket->load(['flight.originAirport', 'flight.destinationAirport', 'passenger']));
    }

    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket->load(['flight.originAirport', 'flight.destinationAirport', 'passenger']));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'flight_id' => 'sometimes|required|exists:flights,id',
            'passenger_id' => 'sometimes|required|exists:passengers,id',
            'seat_number' => 'nullable|string|max:10',
            'passenger_count' => 'sometimes|required|integer|min:1',
            'total_price' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|string|max:50',
        ]);

        $ticket->update($validated);

        return new TicketResource($ticket->load(['flight.originAirport', 'flight.destinationAirport', 'passenger']));
    }

    public function destroy(Ticket $ticket)
    {
        DB::transaction(function () use ($ticket) {
            $flight = $ticket->flight;
            if ($flight) {
                $flight->increment('empty_seats', $ticket->passenger_count);
            }
            $ticket->delete();
        });

        return response()->json(null, 204);
    }
}
