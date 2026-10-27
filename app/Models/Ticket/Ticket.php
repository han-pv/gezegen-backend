<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Haysy uşuşa degişliligi
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    // Hasy ýolagça degişliligi
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
}
