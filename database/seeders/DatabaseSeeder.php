<?php

namespace Database\Seeders;

use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Passenger;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(CitySeeder::class);

        Hotel::factory(100)->create();
        Room::factory(300)->create();


        Airport::factory(10)->create();
        Passenger::factory(50)->create();
        Flight::factory(30)->create();
        Ticket::factory(100)->create();
    }
}
