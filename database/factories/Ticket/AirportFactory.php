<?php

namespace Database\Factories\Ticket;

use App\Models\Model;
use App\Models\Ticket\Airport;  
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
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
            'name' => $this->faker->city . ' Airport',
            'city' => $this->faker->city,
            'code' => strtoupper($this->faker->lexify('???')),
        ];
    }
}
