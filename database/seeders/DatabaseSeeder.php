<?php

namespace Database\Seeders;

use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Tickets\CitySeeder;
use Database\Seeders\Tickets\PassengerSeeder;
use Database\Seeders\Tickets\AirportSeeder;
use Database\Seeders\Tickets\TicketSeeder;
use Database\Seeders\Tickets\FlightSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(CitySeeder::class);
        $this->call(PassengerSeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(FlightSeeder::class);
        $this->call(TicketSeeder::class);

        \App\Models\Tickets\City::factory(15)->create();
        \App\Models\Tickets\Passenger::factory(15)->create();
        \App\Models\Tickets\Airport::factory(15)->create();
        \App\Models\Tickets\Flight::factory(15)->create();
        \App\Models\Tickets\Ticket::factory(15)->create();


        // Hotel::factory(100)->create();

        // Room::factory(300)->create();
    }
}
