<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Airport;
use App\Models\Ticket\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition(): array
    {
        return [
            'airline' => fake()->randomElement(['American Airlines', 'Delta Air Lines', 'United Airlines']),
            'flight_number' => strtoupper(fake()->bothify('??###')),
            'origin_airport_id' => Airport::inRandomOrder()->first()?->id ?? Airport::factory(),
            'destination_airport_id' => Airport::inRandomOrder()->first()?->id ?? Airport::factory(),
            'departure_time' => fake()->dateTimeBetween('+1 days', '+3 days'),
            'arrival_time' => fake()->dateTimeBetween('+4 days', '+6 days'),
            'duration' => '3 hr 15 min',
            'price' => fake()->randomFloat(2, 100, 500),
            'empty_seats' => fake()->numberBetween(1, 30),
        ];
    }
}
