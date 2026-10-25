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
            'from_airport_id' => $this->from_airport_id,
            'to_airport_id' => $this->to_airport_id,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
            'code' => $this->code,
            'airlines' => $this->airlines,
        ];
    }
}
