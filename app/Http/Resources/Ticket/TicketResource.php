<?php

namespace App\Http\Resources\Ticket;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'seat_number' => $this->seat_number,
            'price' => $this->price,
            'flight' => new FlightResource($this->whenLoaded('flight')),
            'passenger' => new PassengerResource($this->whenLoaded('passenger')),
        ];
    }
}
