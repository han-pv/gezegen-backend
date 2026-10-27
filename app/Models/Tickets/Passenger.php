<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[Fillable([
    'first_name',
    'last_name',
    'email',
    'phone',
    'passport_number',
])]
class Passenger extends Model
{
    use HasFactory;
}
