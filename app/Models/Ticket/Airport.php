<?php

namespace App\Models\Ticket;

use Database\Factories\Ticket\AirportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return AirportFactory::new();
    }

    // Uçup gidýän uşuşlar
    public function departingFlights()
    {
        return $this->hasMany(Flight::class, 'from_airport_id');
    }

    // Gelýän uşuşlar
    public function arrivingFlights()
    {
        return $this->hasMany(Flight::class, 'to_airport_id');
    }
}
