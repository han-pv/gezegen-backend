<?php

namespace App\Models\Ticket;

use App\Models\Ticket\Flight;
use App\Models\Ticket\Passanger;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'flight_id',
    'passanger_id',
    'seats_count',
    'total_price',
    'status'
])]
class Ticket extends Model
{

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(Passanger::class, 'passanger_id');
    }
}
