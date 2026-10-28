<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassengerResource;
use App\Models\Ticket\Flight;
use App\Models\Ticket\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PassengerController extends Controller
{
    public function index()
    {
        return PassengerResource::collection(Passenger::orderBy('id')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'email', 'regex:/\.com$/i'],
            'phone' => ['required', 'regex:/^\+[0-9]+$/'],
        ]);

        $passenger = Passenger::create($data);

        return (new PassengerResource($passenger))->response()->setStatusCode(201);
    }

    public function show(Passenger $passenger)
    {
        return new PassengerResource(
            $passenger->load('tickets.flight.fromAirport', 'tickets.flight.toAirport')
        );
    }

    public function update(Request $request, Passenger $passenger)
    {
        $data = $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'email' => ['sometimes', 'required', 'email', 'regex:/\.com$/i'],
            'phone' => ['sometimes', 'required', 'regex:/^\+[0-9]+$/'],
        ]);

        $passenger->update($data);

        return new PassengerResource($passenger);
    }

    public function destroy(Passenger $passenger)
    {
        DB::transaction(function () use ($passenger) {
            foreach ($passenger->tickets as $ticket) {
                Flight::lockForUpdate()->find($ticket->flight_id)?->increment('seats_available');
            }

            $passenger->delete();
        });

        return response()->noContent();
    }
}