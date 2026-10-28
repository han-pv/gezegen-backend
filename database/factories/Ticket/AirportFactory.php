<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirportFactory extends Factory
{
    protected $model = Airport::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Airport',
            'code' => strtoupper(fake()->unique()->lexify('???')),
            'city' => fake()->city(),
            'country' => fake()->country(),
        ];
    }
}
