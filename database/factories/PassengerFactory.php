<?php

namespace Database\Factories;

use App\Models\Tickets\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    protected $model = Passenger::class;

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
