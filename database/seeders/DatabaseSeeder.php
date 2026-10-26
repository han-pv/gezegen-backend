<?php

namespace Database\Seeders;

use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
use App\Models\Airport;
use App\Models\Tickets\Flight;
use App\Models\Tickets\Passenger;
use App\Models\Tickets\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CitySeeder::class,
            AirportSeeder::class,
            HotelSeeder::class,
            RoomSeeder::class,
            PassengerSeeder::class,
            FlightSeeder::class,
            TicketSeeder::class,
        ]);
    }
}
