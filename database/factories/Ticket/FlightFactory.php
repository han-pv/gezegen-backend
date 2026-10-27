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
        $fromAirport = Airport::inRandomOrder()->first() ?? Airport::factory()->create();
        $toAirport = Airport::inRandomOrder()->where('id', '!=', $fromAirport->id)->first() ?? Airport::factory()->create();

        return [
            'airline' => $this->faker->randomElement(['American Airlines', 'Delta Air Lines', 'United Airlines', 'Emirates']),
            'flight_number' => strtoupper($this->faker->bothify('AA-###')),
            'from_airport_id' => $fromAirport->id,
            'to_airport_id' => $toAirport->id,
            'departure_time' => $this->faker->dateTimeBetween('+1 days', '+5 days'),
            'arrival_time' => $this->faker->dateTimeBetween('+6 days', '+10 days'),
            'price' => $this->faker->randomFloat(2, 120, 450),
            'empty_seats' => $this->faker->numberBetween(10, 50),
        ];
    }
}