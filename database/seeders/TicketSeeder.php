<?php

namespace Database\Seeders;

use App\Models\Ticket\Flight;
use App\Models\Ticket\Passenger;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $flight = Flight::where('seats_available', '>', 0)
                ->inRandomOrder()
                ->first();

            $passenger = Passenger::inRandomOrder()->first();

            Ticket::create([
                'flight_id' => $flight->id,
                'passenger_id' => $passenger->id,
                'price' => $flight->price,
            ]);

            $flight->decrement('seats_available');
        }
    }
}
