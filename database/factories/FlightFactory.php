<?php

namespace Database\Factories;

use App\Models\Airport;
use App\Models\Tickets\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition(): array
    {
        $departure = $this->faker->dateTimeBetween('+1 days', '+30 days');
        $arrival = (clone $departure)->modify('+' . rand(1, 12) . ' hours');
        $totalSeats = $this->faker->numberBetween(50, 300);

        return [
            'departure_airport_id' => Airport::inRandomOrder()->first()->id,
            'arrival_airport_id'   => Airport::inRandomOrder()->first()->id,
            'departure_time'       => $departure,
            'arrival_time'         => $arrival,
            'total_seats'          => $totalSeats,
            'available_seats'      => $totalSeats,
            'price'                => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}
