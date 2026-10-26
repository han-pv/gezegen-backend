<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Airport>
 */
class AirportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->city().' Airport',
            'code' => strtoupper(fake()->unique()->lexify('???')),
            'city' => fake()->city(),
        ];
    }
}
