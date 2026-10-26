<?php

namespace Database\Seeders;

use App\Models\Ticket\Flight;
// use Database\Factories\Ticket\FlightFactory;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        // FlightFactory::new()->count(5)->create();

        Flight::create([
            'airline' => 'American Airlines',
            'flight_number' => 'AA101',
            'origin_airport_id' => 1,
            'destination_airport_id' => 2,
            'departure_time' => '2026-10-26 18:00:00',
            'arrival_time' => '2026-10-26 21:15:00',
            'duration' => '3 hr 15 min',
            'price' => 180.00,
            'empty_seats' => 1,
        ]);

        Flight::create([
            'airline' => 'American Airlines',
            'flight_number' => 'AA100',
            'origin_airport_id' => 1,
            'destination_airport_id' => 2,
            'departure_time' => '2026-10-26 08:30:00',
            'arrival_time' => '2026-10-26 11:40:00',
            'duration' => '3 hr 10 min',
            'price' => 260.00,
            'empty_seats' => 20,
        ]);

        Flight::create([
            'airline' => 'Delta Air Lines',
            'flight_number' => 'DL205',
            'origin_airport_id' => 2,
            'destination_airport_id' => 3,
            'departure_time' => '2026-10-27 12:00:00',
            'arrival_time' => '2026-10-27 16:30:00',
            'duration' => '4 hr 30 min',
            'price' => 210.00,
            'empty_seats' => 15,
        ]);

        Flight::create([
            'airline' => 'United Airlines',
            'flight_number' => 'UA500',
            'origin_airport_id' => 3,
            'destination_airport_id' => 4,
            'departure_time' => '2026-10-28 20:00:00',
            'arrival_time' => '2026-10-29 08:00:00',
            'duration' => '7 hr 00 min',
            'price' => 540.00,
            'empty_seats' => 5,
        ]);

        Flight::create([
            'airline' => 'Emirates',
            'flight_number' => 'EK215',
            'origin_airport_id' => 1,
            'destination_airport_id' => 5,
            'departure_time' => '2026-10-30 14:15:00',
            'arrival_time' => '2026-10-30 17:45:00',
            'duration' => '6 hr 30 min',
            'price' => 320.00,
            'empty_seats' => 12,
        ]);
    }
}
