<?php

namespace App\Http\Resources;

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
            'origin_airport_id' => $this->origin_airport_id,
            'destination_airport_id' => $this->destination_airport_id,
            'origin_airport' => new AirportResource($this->whenLoaded('originAirport')),
            'destination_airport' => new AirportResource($this->whenLoaded('destinationAirport')),
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'duration' => $this->duration,
            'price' => $this->price,
            'empty_seats' => $this->empty_seats,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
