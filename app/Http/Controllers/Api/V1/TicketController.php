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
        $flight = Flight::find($request->flight_id);

        // Göni tickets tablisasyna maglumatlary ýazýarys
        $ticket = Ticket::create([
            'flight_id' => $request->flight_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'passport_number' => $request->passport_number,
            'seat_number' => $request->seat_number ?? '12A',
            'seats_count' => 1,
            'total_price' => $flight ? $flight->price : 100,
        ]);

        // Uçuň boş orun sanyny 1 sany kemeltmek
        // Uçuň boş orun sanyny 1 sany kemeltmek
        if ($flight) {
            $flight->decrement('empty_seats');
        }

        return response()->json([
            'message' => 'Bilet üstünlikli alyndy!',
            'seats' => $flight->empty_seats ?? 0
        ]);
    }
}
