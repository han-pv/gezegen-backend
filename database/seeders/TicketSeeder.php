<?php

namespace Database\Seeders;

use App\Models\Ticket\Ticket;
// use Database\Factories\Ticket\TicketFactory;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        // TicketFactory::new()->count(5)->create();

        Ticket::create([
            'flight_id' => 1,
            'passenger_id' => 1,
            'seat_number' => '12A',
            'passenger_count' => 1,
            'total_price' => 180.00,
            'status' => 'booked',
        ]);

        Ticket::create([
            'flight_id' => 2,
            'passenger_id' => 2,
            'seat_number' => '14C',
            'passenger_count' => 1,
            'total_price' => 260.00,
            'status' => 'booked',
        ]);

        Ticket::create([
            'flight_id' => 3,
            'passenger_id' => 3,
            'seat_number' => '5B',
            'passenger_count' => 2,
            'total_price' => 420.00,
            'status' => 'booked',
        ]);

        Ticket::create([
            'flight_id' => 4,
            'passenger_id' => 4,
            'seat_number' => '22F',
            'passenger_count' => 1,
            'total_price' => 540.00,
            'status' => 'booked',
        ]);
    }
}
