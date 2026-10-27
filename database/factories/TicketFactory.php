<?php

namespace Database\Factories;

use App\Models\Ticket\Flight;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'code'        => fake()->unique()->regexify('[A-Z0-9]{8}'),
            'flight_id'   => Flight::inRandomOrder()->value('id') ?? Flight::factory(),
            'total_price' => 0,
            'status'      => fake()->randomElement(['confirmed', 'confirmed', 'confirmed', 'cancelled']),
        ];
    }
}