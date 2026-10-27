<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'flight' => new FlightResource($this->whenLoaded('flight')),
            'passenger' => new PassengerResource($this->whenLoaded('passenger')),
            'price' => $this->price,
        ];
    }
}
