<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Models\Tickets\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        return response()->json(Ticket::with(['flight.departureAirport', 'flight.arrivalAirport', 'passenger'])->get());
    }

    public function store(StoreTicketRequest $request)
        {
            $validated = $request->validated();
            $flight = \App\Models\Tickets\Flight::findOrFail($validated['flight_id']);

            if (isset($validated['passengers']) && is_array($validated['passengers'])) {
                $tickets = [];

                foreach ($validated['passengers'] as $passengerData) {
                    $passenger = \App\Models\Tickets\Passenger::create([
                        'full_name' => $passengerData['full_name'] ?? null,
                        'email'     => $passengerData['email'] ?? null,
                        'phone'     => $passengerData['phone'] ?? null,
                    ]);

                    $ticket = Ticket::create([
                        'flight_id' => $flight->id,
                        'passenger_id' => $passenger->id,
                        'seat'      => $passengerData['seat'] ?? ('A' . rand(1, 30)), // Fallback seat generator if not provided
                        'price'     => $flight->price,
                        'status'    => 'Booked',
                    ]);

                    $flight->decrement('total_seats');

                    $tickets[] = $ticket->load(['flight.departureAirport', 'flight.arrivalAirport', 'passenger']);
                }

                return response()->json($tickets, 201);
            }

            // Fallback for single ticket creation
            $ticket = Ticket::create($validated);
            $flight->decrement('total_seats');

            return response()->json($ticket->load(['flight.departureAirport', 'flight.arrivalAirport', 'passenger']), 201);
        }

    public function show(string $id)
    {
        $ticket = Ticket::with(['flight.departureAirport', 'flight.arrivalAirport', 'passenger'])->findOrFail($id);
        return response()->json($ticket);
    }
    public function update(UpdateTicketRequest $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->validated());
        return response()->json($ticket->load(['flight.departureAirport', 'flight.arrivalAirport', 'passenger']));
    }

    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted successfully']);
    }
}
