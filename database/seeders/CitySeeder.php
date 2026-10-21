<?php

namespace Database\Seeders;

use App\Models\Hotel\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Seed ten cities.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'İstanbul', 'slug' => 'istanbul'],
            ['name' => 'Ankara', 'slug' => 'ankara'],
            ['name' => 'İzmir', 'slug' => 'izmir'],
            ['name' => 'Antalya', 'slug' => 'antalya'],
            ['name' => 'Bursa', 'slug' => 'bursa'],
            ['name' => 'Adana', 'slug' => 'adana'],
            ['name' => 'Trabzon', 'slug' => 'trabzon'],
            ['name' => 'Konya', 'slug' => 'konya'],
            ['name' => 'Gaziantep', 'slug' => 'gaziantep'],
            ['name' => 'Muğla', 'slug' => 'mugla'],
        ];

        foreach ($cities as $city) {
            City::query()->updateOrCreate(
                ['slug' => $city['slug']],
                ['name' => $city['name']],
            );
        }
    }
}
