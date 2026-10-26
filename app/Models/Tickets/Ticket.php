<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\TicketFactory::new();
    }

    protected $fillable = [
        'flight_id',
        'passenger_id',
        'seat_number',
        'status',
        'price',
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
