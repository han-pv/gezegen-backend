<?php

namespace App\Models\Api\V1;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'code',
    'from_airport_id',
    'to_airport_id',
    'from_time',
    'to_time',
    'airlines',
])]

class Flight extends Model
{
    public function airport(): BelongsTo
    {
        return $this->belongsTo(Airport::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
