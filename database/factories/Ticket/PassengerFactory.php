<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    protected $model = Passenger::class;

    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'passport_number' => strtoupper(fake()->bothify('??########')),
        ];
    }
}
