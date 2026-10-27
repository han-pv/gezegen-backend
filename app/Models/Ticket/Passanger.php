<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'full_name',
    'email',
    'card_num',
    'phone',
    'passport_code',
])]
class Passanger extends Model
{
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
