<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\Ticket\PassengerFactory;

class Passenger extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return PassengerFactory::new();
    }

    // Ýolagçynyň petekleri
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
