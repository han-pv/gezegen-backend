<?php

namespace App\Models\Ticket;

use App\Models\Hotel\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\FlightFactory;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_city_id', 'to_city_id', 'airline', 'flight_number',
        'departure_at', 'arrival_at', 'price',
        'total_seats', 'available_seats', 'active',
    ];

    protected $casts = [
        'departure_at' => 'datetime',
        'arrival_at'   => 'datetime',
        'price'        => 'decimal:2',
        'active'       => 'boolean',
    ];

    public function fromCity()
    {
        return $this->belongsTo(City::class, 'from_city_id');
    }

    public function toCity()
    {
        return $this->belongsTo(City::class, 'to_city_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    protected static function newFactory()
    {
        return FlightFactory::new();
    }
}