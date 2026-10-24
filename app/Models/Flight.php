<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{

    use HasFactory;

    protected $fillable = [
        'departure_airport_id',
        'arrival_airport_id',
        'departure_time',
        'arrival_time',
        'total_seats',
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
