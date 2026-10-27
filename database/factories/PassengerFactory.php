<?php

namespace Database\Factories;

use App\Models\Ticket\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    protected $model = Passenger::class;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name'  => fake()->lastName(),
            'age'        => fake()->numberBetween(2, 80),
            'phone'      => fake()->phoneNumber(),
        ];
    }
}