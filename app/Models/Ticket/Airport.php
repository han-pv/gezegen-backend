<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'code',
    'city',
])]
class Airport extends Model
{
    /** @use HasFactory<\Database\Factories\Ticket\AirportFactory> */
    use HasFactory;

    public function departingFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'from_airport_id');
    }

    public function arrivingFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'to_airport_id');
    }
}
