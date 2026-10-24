<?php

namespace Database\Factories;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    public function definition(): array
    {
        $departure = $this->faker->dateTimeBetween('+1 days', '+30 days');
        $arrival = (clone $departure)->modify('+' . rand(1, 12) . ' hours');

        return [
            'departure_airport_id' => Airport::inRandomOrder()->first()->id,
            'arrival_airport_id'   => Airport::inRandomOrder()->first()->id,
            'departure_time'       => $departure,
            'arrival_time'         => $arrival,
            'total_seats'          => $this->faker->numberBetween(50, 300),
            'price'                => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}
