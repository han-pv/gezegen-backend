<?php

namespace App\Models\Hotel;

use Database\Factories\Hotel\HotelFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'city_id',
    'name',
    'slug',
    'address',
    'capacity',
    'stars',
    'phone',
    'image',
    'rating',
    'active',
    'email',
    'description',
])]
class Hotel extends Model
{
    /** @use HasFactory<HotelFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
            'stars' => 'integer',
            'rating' => 'decimal:2',
            'active' => 'boolean',
        ];
    }


    /**
     * Get the city that owns the hotel.
     *
     * @return BelongsTo<City, $this>
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
