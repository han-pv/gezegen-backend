<?php

namespace Database\Seeders\Tickets;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Tickets\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets=[
            ['flight_id' => 1, 'date' => '2026-11-01', 'price' => 300, 'seats'=>20],
            ['flight_id' => 2, 'date' => '2026-11-02', 'price' => 250, 'seats'=>20],
            ['flight_id' => 3, 'date' => '2026-11-03', 'price' => 200, 'seats'=>20],
            ['flight_id' => 4, 'date' => '2026-11-04', 'price' => 150, 'seats'=>20],
            ['flight_id' => 5, 'date' => '2026-11-05', 'price' => 100, 'seats'=>20],
            ['flight_id' => 6, 'date' => '2026-11-06', 'price' => 350, 'seats'=>20],
            ['flight_id' => 7, 'date' => '2026-11-07', 'price' => 400, 'seats'=>20],
            ['flight_id' => 8, 'date' => '2026-11-08', 'price' => 450, 'seats'=>20],
            ['flight_id' => 9, 'date' => '2026-11-09', 'price' => 500, 'seats'=>20],
            ['flight_id' => 10, 'date' => '2026-11-10', 'price' => 550, 'seats'=>20],

        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
