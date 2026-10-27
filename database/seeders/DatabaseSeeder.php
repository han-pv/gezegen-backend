<?php

namespace Database\Seeders;

// use App\Models\Hotel\Hotel;
// use App\Models\Hotel\Room;
use App\Models\Ticket\Flight;
// use App\Models\User;
use Database\Seeders\Ticket\AirportSeeder;
use Database\Seeders\Ticket\CitySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $this->call([
            CitySeeder::class,
            AirportSeeder::class,
        ]);

        Flight::factory(100)->create();

        // Hotel::factory(100)->create();

        // Room::factory(300)->create();
    }
}
