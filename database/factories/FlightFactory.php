<?php

namespace Database\Factories; 

use App\Models\Hotel\City;
use App\Models\Ticket\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ticket\Airplane;

/**
 * @extends Factory<Flight>
 */
class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition(): array
    {
        [$from, $to] = City::inRandomOrder()->limit(2)->pluck('id')->all();

        $airplane = Airplane::where('active', true)->inRandomOrder()->first()
            ?? Airplane::factory()->create();

        $departure = fake()->dateTimeBetween('+1 day', '+60 days');
        $arrival   = (clone $departure)->modify('+' . fake()->numberBetween(1, 10) . ' hours');

        return [
            'from_city_id'    => $from,
            'to_city_id'      => $to,
            'airplane_id'     => $airplane->id,
            'airline'         => $airplane->airline,
            'flight_number'   => strtoupper(fake()->lexify('??')) . fake()->numberBetween(100, 999),
            'departure_at'    => $departure,
            'arrival_at'      => $arrival,
            'price'           => fake()->randomFloat(2, 80, 900),
            'total_seats'     => $airplane->capacity,
            'available_seats' => $airplane->capacity,
            'active'          => true,
        ];
    }
}