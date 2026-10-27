<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'flight_id' => $this->flight_id,
            'passenger_id' => $this->passenger_id,
            'flight' => new FlightResource($this->whenLoaded('flight')),
            'passenger' => new PassengerResource($this->whenLoaded('passenger')),
            'seat_number' => $this->seat_number,
            'passenger_count' => $this->passenger_count,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
