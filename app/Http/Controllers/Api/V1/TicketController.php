<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Http\Resources\TicketResource;
use App\Models\Api\V1\Ticket;

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
}
