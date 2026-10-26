<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'code',
    'city',
])]
class Airport extends Model
{
    /** @use HasFactory<\Database\Factories\Ticket\AirportFactory> */
    use HasFactory;
}
