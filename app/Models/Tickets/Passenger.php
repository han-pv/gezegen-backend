<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{

    use HasFactory;

    protected static function newFactory()
    {
           return \Database\Factories\PassengerFactory::new();
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'passport_number',
        'date_of_birth',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function flights()
    {
        return $this->hasManyThrough(Flight::class, Ticket::class);
    }
}
