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
            ['name' => 'Ashgabat', 'slug' => 'ashgabat'],
            ['name' => 'New York', 'slug' => 'new-york'],
            ['name' => 'İzmir', 'slug' => 'izmir'],
            ['name' => 'Ankara', 'slug' => 'ankara'],
            ['name' => 'Beijing', 'slug' => 'beijing'],
        ];

        foreach ($cities as $city) {
            City::query()->updateOrCreate(
                ['slug' => $city['slug']],
                ['name' => $city['name']],
            );
        }
    }
}
