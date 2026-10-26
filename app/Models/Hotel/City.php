<?php

namespace App\Models\Hotel;

use Database\Factories\CityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function newFactory()
    {
        return CityFactory::new();
    }

    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }
}
