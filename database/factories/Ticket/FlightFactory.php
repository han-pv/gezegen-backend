<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Flight;
use App\Models\Ticket\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        [$from, $to] = Airport::pluck('id')->random(2)->values()->all();

        $departure = fake()->dateTimeBetween('+1 day', '+30 days');
        $arrival = (clone $departure)->modify('+' . fake()->numberBetween(1, 10) . ' hours');
        return [
            'airline' => fake()->randomElement(['Turkmenistan Airlines', 'Turkish Airlines', 'Aeroflot']),
            'flight_number' => strtoupper(fake()->lexify('??')) . fake()->numerify('###'),
            'price' => fake()->randomFloat(2, 50, 500),
            'seats_available' => fake()->numberBetween(0, 100),
            'from_airport_id' => $from,
            'to_airport_id' => $to,
            'departure_at' => $departure,
            'arrival_at' => $arrival,
        ];
    }
}
