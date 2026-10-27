<?php

namespace App\Models\Ticket;

use Database\Factories\PassengerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id', 'first_name', 'last_name', 'age', 'phone',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    protected static function newFactory()
    {
        return PassengerFactory::new();
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}