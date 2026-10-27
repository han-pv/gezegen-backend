<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\TicketFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'flight_id', 'total_price', 'status'
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    protected static function newFactory()
    {
        return TicketFactory::new();
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}