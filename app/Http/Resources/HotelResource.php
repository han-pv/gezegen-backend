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
            'name' => $this->name,
            'slug' => $this->slug,
            'address' => $this->address,
            'capacity' => $this->capacity,
            'stars' => $this->stars,
            'phone' => $this->phone,
            'image' => $this->image,
            'rating' => $this->rating,
            'active' => $this->active,
            'email' => $this->email,
            'description' => $this->description,
        ];
    }
}
