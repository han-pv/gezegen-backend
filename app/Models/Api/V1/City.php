<?php

namespace App\Models\Api\V1;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'slug',
])]

class City extends Model
{
    public function airports()
    {
        return $this->hasMany(Airport::class);
    }
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

}
