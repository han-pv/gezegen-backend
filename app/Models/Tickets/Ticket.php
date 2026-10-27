<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'flight_id',
    'date',
    'price',
])]

class Ticket extends Model
{
    use HasFactory;
    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
}

