<?php

namespace App\Models\Api\V1;

use Illuminate\Database\Eloquent\Attributes\Fillable;
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
    //
}
