<?php

namespace Database\Factories\Tickets;

use App\Models\Tickets\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tickets\Airport;

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
        return [
            'from_airport_id' => Airport::factory(),
            'to_airport_id' => Airport::factory(),
            'from_time' => $this->faker->time('H:i:s'),
            'to_time' => $this->faker->time('H:i:s'),
            'code' => strtoupper($this->faker->unique()->bothify('??###')), // Например: AA101
            'airlines' => $this->faker->company(),
        ];
    }
}
