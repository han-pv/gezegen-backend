<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'email'           => $this->faker->unique()->safeEmail,
            'phone'           => $this->faker->phoneNumber,
            'passport_number' => strtoupper($this->faker->unique()->bothify('??#######')),
            'date_of_birth'   => $this->faker->date('Y-m-d', '-18 years'),
        ];
    }
}
