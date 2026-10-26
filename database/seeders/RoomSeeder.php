<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = Hotel::all();

        if ($hotels->isEmpty()) {
            $this->call(HotelSeeder::class);
            $hotels = Hotel::all();
        }

        $hotels->each(function (Hotel $hotel) {
            Room::factory()
                ->count(20)
                ->for($hotel)
                ->create();
        });
    }
}
