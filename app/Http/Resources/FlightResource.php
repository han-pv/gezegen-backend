<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'airline' => $this->airline,
            'flight_number' => $this->flight_number,
            'price' => $this->price,
            'seats_available' => $this->seats_available,
            'departure_at' => $this->departure_at,
            'arrival_at' => $this->arrival_at,
            'from_airport' => new AirportResource($this->whenLoaded('fromAirport')),
            'to_airport' => new AirportResource($this->whenLoaded('toAirport')),
        ];
    }
}
