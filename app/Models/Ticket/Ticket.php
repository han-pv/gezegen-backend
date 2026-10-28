<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_id',
        'passenger_id',
        'seat_number',
        'passenger_count',
        'total_price',
        'status',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
}
