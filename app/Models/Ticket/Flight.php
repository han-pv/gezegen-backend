<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'airline',
    'flight_number',
    'from_airport_id',
    'to_airport_id',
    'departure_at',
    'arrival_at',
    'price',
    'seats_available',
])]
class Flight extends Model
{
    /** @use HasFactory<\Database\Factories\Ticket\FlightFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'departure_at' => 'datetime',
            'arrival_at' => 'datetime',
            'price' => 'decimal:2',
        ];
    }

    public function fromAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'from_airport_id');
    }

    public function toAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'to_airport_id');
    }
}