<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketStoreRequest;
use App\Models\Ticket\Flight;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(TicketStoreRequest $request)
{
    $data  = $request->validated();
    $count = count($data['passengers']);

    $ticket = DB::transaction(function () use ($data, $count) {
        $flight = Flight::lockForUpdate()->findOrFail($data['flight_id']);

        if (! $flight->active || $flight->departure_at->isPast()) {
            abort(422, 'Bu reýs elýeterli däl.');
        }

        if ($flight->available_seats < $count) {
            abort(422, 'Ýeterlik boş ýer ýok.');
        }

        $flight->decrement('available_seats', $count);

        $ticket = Ticket::create([
            'code'          => strtoupper(Str::random(8)),
            'flight_id'     => $flight->id,
            'total_price'   => $flight->price * $count,
        ]);

        $ticket->passengers()->createMany($data['passengers']);

        return $ticket;
    });

    return response()->json(
        $ticket->load('passengers', 'flight.fromCity', 'flight.toCity'),
        201
    );
}

public function show($code)
{
    $ticket = Ticket::with('passengers', 'flight.fromCity', 'flight.toCity')
        ->where('code', $code)
        ->firstOrFail();

    return response()->json($ticket);
}

public function quote(Request $request)
{
    $data = $request->validate([
        'flight_id'  => ['required', 'integer', 'exists:flights,id'],
        'passengers' => ['required', 'integer', 'min:1', 'max:9'],
    ]);

    $flight = Flight::findOrFail($data['flight_id']);

    return response()->json([
        'price_per_seat'  => $flight->price,
        'passengers'      => $data['passengers'],
        'total_price'     => round($flight->price * $data['passengers'], 2),
        'available_seats' => $flight->available_seats,
    ]);
}
}