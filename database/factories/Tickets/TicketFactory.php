<?php

namespace Database\Factories\Tickets;

use App\Models\Tickets\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tickets\Flight;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_id' => Flight::factory(),
            'date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'price' => $this->faker->numberBetween(150, 800),
            'seats' => 20, 
        ];
    }
}
