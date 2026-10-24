<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        return response()->json(Ticket::with(['flight', 'passenger'])->get());
    }

    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create($request->validated());
        return response()->json($ticket->load(['flight', 'passenger']), 201);
    }

    public function show(string $id)
    {
        $ticket = Ticket::with(['flight', 'passenger'])->findOrFail($id);
        return response()->json($ticket);
    }

    public function update(UpdateTicketRequest $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->validated());
        return response()->json($ticket->load(['flight', 'passenger']));
    }

    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted successfully']);
    }
}
