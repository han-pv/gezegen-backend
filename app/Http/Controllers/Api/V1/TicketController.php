<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket\Flight;
use App\Models\Ticket\Passenger;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('flight.fromAirport', 'flight.toAirport', 'passenger')
            ->latest()
            ->get();

        return TicketResource::collection($tickets);
    }

    public function show(Ticket $ticket)
    {
        return new TicketResource(
            $ticket->load('flight.fromAirport', 'flight.toAirport', 'passenger')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'flight_id' => 'required|integer|exists:flights,id',
            'passengers' => 'required|array|min:1',
            'passengers.*.full_name' => 'required|string|max:255',
            'passengers.*.email' => ['required', 'email', 'regex:/\.com$/i'],
            'passengers.*.phone' => ['required', 'regex:/^\+[0-9]+$/'],
        ]);

        $ticketIds = DB::transaction(function () use ($data) {
            $flight = Flight::lockForUpdate()->findOrFail($data['flight_id']);
            $count = count($data['passengers']);

            if ($flight->seats_available < $count) {
                throw ValidationException::withMessages([
                    'passengers' => ['Not enough empty seats on this flight.'],
                ]);
            }

            $ids = [];

            foreach ($data['passengers'] as $passengerData) {
                $passenger = Passenger::create($passengerData);

                $ticket = Ticket::create([
                    'flight_id' => $flight->id,
                    'passenger_id' => $passenger->id,
                    'price' => $flight->price,
                ]);

                $ids[] = $ticket->id;
            }

            $flight->decrement('seats_available', $count);

            return $ids;
        });

        $tickets = Ticket::with('flight.fromAirport', 'flight.toAirport', 'passenger')
            ->whereIn('id', $ticketIds)
            ->get();

        return TicketResource::collection($tickets)->response()->setStatusCode(201);
    }
}