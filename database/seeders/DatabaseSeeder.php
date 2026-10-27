<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AirportSeeder::class,
            FlightSeeder::class,
            PassengerSeeder::class,
            TicketSeeder::class,
        ]);
    }
}