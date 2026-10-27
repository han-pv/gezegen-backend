<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
    'name',
    'slug',
])]

class City extends Model
{

    use HasFactory;
    public function airports()
    {
        return $this->hasMany(Airport::class);
    }
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

}
