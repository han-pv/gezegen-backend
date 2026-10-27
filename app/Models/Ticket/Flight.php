<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\Ticket\FlightFactory;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return FlightFactory::new();
    }

    // Nireden uçaýandygy
    public function fromAirport()
    {
        return $this->belongsTo(Airport::class, 'from_airport_id');
    }

    // Nira barýandygy
    public function toAirport()
    {
        return $this->belongsTo(Airport::class, 'to_airport_id');
    }

    // Uşuşa degişli petekler
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}