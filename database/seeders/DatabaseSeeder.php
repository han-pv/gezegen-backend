<?php

namespace Database\Seeders;

use App\Models\Hotel\City;
use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
use App\Models\User;
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
        User::factory(5)->create();

        City::factory(5)->create()->each(function (City $city) {
            Hotel::factory(rand(2, 4))->create([
                'city_id' => $city->id,
            ])->each(function (Hotel $hotel) {
                Room::factory(rand(5, 10))->create([
                    'hotel_id' => $hotel->id,
                ]);
            });
        });

        $this->call([
            CitySeeder::class,
            HotelSeeder::class,
            RoomSeeder::class,
            FlightSeeder::class,
            TicketSeeder::class,
        ]);
    }
}
