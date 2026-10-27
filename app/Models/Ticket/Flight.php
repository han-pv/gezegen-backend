<?php

namespace App\Models\Ticket;

use App\Models\Ticket\Airport;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\DataCollector\TimeDataCollector;

#[Fillable([
    'airline',
    'flight_code',
    'departure_airport_id',
    'arrival_airport_id',
    'departure_time',
    'arrival_time',
    'price',
    'empty_seats',
    'status',
])]
class Flight extends Model
{

    use HasFactory;
    
    public function departureAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'flight_id');
    }

    public function getFormattedTimesAttribute()
    {
        $depTz = $this->departureAirport->timezone ?? 'Asia/Ashgabat';

        $arrTz = $this->arrivalAirport->timezone ?? 'UTC';

        return [ 
            'departure_local' => $this->departure_time
                ? Carbon::parse($this->departure_time)->format('Y-m-d H:i') : null,

            'arrival_local' => $this->arrival_time
                ? Carbon::parse($this->arrival_time)->format('Y-m-d H:i') : null,
        ];
    }
}
