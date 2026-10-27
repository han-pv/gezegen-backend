<?php

namespace App\Models\Tickets;

use App\Models\Tickets\City;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Api\V1\AirportSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'name',
    'code',
    'city_id',
])]

class Airport extends Model
{
    use HasFactory;
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }


}
