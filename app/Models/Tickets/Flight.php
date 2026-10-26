<?php

namespace App\Models\Tickets;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\FlightFactory::new();
    }

    protected $fillable = [
        'departure_airport_id',
        'arrival_airport_id',
        'departure_time',
        'arrival_time',
        'total_seats',
        'available_seats',
        'price',
    ];

    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
