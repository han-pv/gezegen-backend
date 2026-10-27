<?php

namespace App\Http\Resources\Ticket;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'airline' => $this->airline,
            'flight_number' => $this->flight_number,
            'from_airport' => new AirportResource($this->whenLoaded('fromAirport')),
            'to_airport' => new AirportResource($this->whenLoaded('toAirport')),
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'price' => $this->price,
            'empty_seats' => $this->empty_seats,
        ];
    }
}
