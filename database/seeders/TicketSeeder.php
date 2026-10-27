<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\Passenger;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::factory()->count(30)->create()->each(function (Ticket $ticket) {
        $count = rand(1, 3);

        Passenger::factory()->count($count)->for($ticket)->create();

        $ticket->update([
            'total_price' => $ticket->flight->price * $count,
        ]);
    });
    }
}
