<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Flight;
use App\Models\Ticket\Passenger;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'flight_id' => Flight::inRandomOrder()->first()?->id ?? Flight::factory(),
            'passenger_id' => Passenger::inRandomOrder()->first()?->id ?? Passenger::factory(),
            'seat_number' => fake()->randomElement(['12A', '14B', '3C', '22F']),
            'passenger_count' => 1,
            'total_price' => 180.00,
            'status' => 'booked',
        ];
    }
}
