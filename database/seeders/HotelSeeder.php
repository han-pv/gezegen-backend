<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel\City;
use App\Models\Hotel\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = City::all();

        if ($cities->isEmpty()) {
            $this->call(CitySeeder::class);
            $cities = City::all();
        }

        $cities->each(function (City $city) {
            Hotel::factory()
                ->count(3)
                ->for($city)
                ->create();
        });
    }
}
