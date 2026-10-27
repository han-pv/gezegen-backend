<?php

namespace App\Models\Ticket;

use Database\Factories\AirplaneFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline', 'model', 'registration_number', 'capacity', 'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected static function newFactory()
    {
        return AirplaneFactory::new();
    }

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}