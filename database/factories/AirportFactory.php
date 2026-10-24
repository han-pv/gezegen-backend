<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AirportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'    => $this->faker->city . ' International Airport',
            'code'    => strtoupper($this->faker->unique()->lexify('???')),
            'city'    => $this->faker->city,
            'country' => $this->faker->country,
        ];
    }
}
