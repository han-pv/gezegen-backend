<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
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
            'city_id' => $this->city_id,
            'city' => new CityResource($this->whenLoaded('city')),
            'name' => $this->name,
            'slug' => $this->slug,
            'address' => $this->address,
            'capacity' => $this->capacity,
            'phone' => $this->phone,
            'rating' => $this->rating,
            'description' => $this->description,
            'image' => $this->image,
            'active' => (bool) $this->active,
            'rooms' => $this->RoomResource::collection($this->whenLoaded('rooms')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
