<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Hotel\City;
use Database\Factories\HotelFactory;

class Hotel extends Model
{
    use HasFactory;

    protected static function newFactory(): HotelFactory
    {
        return HotelFactory::new();
    }

    protected $fillable = [
        'city_id',
        'name',
        'slug',
        'address',
        'phone',
        'rating',
        'description',
        'image',
        'active',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}