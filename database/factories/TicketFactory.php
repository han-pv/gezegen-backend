<?php

namespace Database\Factories;

use App\Models\Tickets\Flight;
use App\Models\Tickets\Passenger;
use App\Models\Tickets\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'flight_id'    => Flight::inRandomOrder()->first()->id,
            'passenger_id' => Passenger::inRandomOrder()->first()->id,
            'seat_number'  => strtoupper($this->faker->bothify('?##')),
            'status'       => $this->faker->randomElement(['booked', 'cancelled', 'completed']),
            'price'        => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}
