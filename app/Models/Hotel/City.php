<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'slug', 'code'])]
class City extends Model
{
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
