<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Http\Resources\TicketResource;
use App\Models\Tickets\Passenger;
use App\Models\Tickets\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::get();

        return TicketResource::collection($tickets)->additional(['success' => true]);
    }
    public function store(TicketStoreRequest $request)
    {
        $ticket = Ticket::create($request->validated());

        return (new TicketResource($ticket))
            ->additional(['success' => true, 'message' => 'Ticket successfully created'])
            ->response()
            ->setStatusCode(201);
    }
    public function show(Ticket $ticket)
    {
        return (new TicketResource($ticket))
            ->additional(['success' => true]);
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());

        return (new TicketResource($ticket))
            ->additional(['success' => true, 'message' => 'Ticket successfully updated']);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ticket successfully deleted'
        ], 200);
    }

    public function book(Request $request, Ticket $ticket)
    {
        if ($ticket->seats < 1) {
            return response()->json(['message' => 'No empty seats left'], 400);
        }

        $validated = $request->validate([
            'first_name'      => 'required|string',
            'last_name'       => 'required|string',
            'email'           => 'required|email',
            'phone'           => 'required|string',
            'passport_number' => 'required|string',
        ]);

        Passenger::create($validated);

        $ticket->decrement('seats');

        return response()->json([
            'message' => 'Successfully booked',
            'seats'   => $ticket->seats
        ]);
    }
}
