<?php

namespace Database\Seeders\Tickets;

use App\Models\Tickets\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Seed ten cities.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'New York', 'slug' => 'new-york'],
            ['name' => 'Los Angeles', 'slug' => 'los-angeles'],
            ['name' => 'Chicago', 'slug' => 'chicago'],
            ['name' => 'Houston', 'slug' => 'houston'],
            ['name' => 'Phoenix', 'slug' => 'phoenix'],
            ['name' => 'Philadelphia', 'slug' => 'philadelphia'],
            ['name' => 'San Antonio', 'slug' => 'san-antonio'],
            ['name' => 'San Diego', 'slug' => 'san-diego'],
            ['name' => 'Dallas', 'slug' => 'dallas'],
            ['name' => 'San Jose', 'slug' => 'san-jose'],
            
        ];

        foreach ($cities as $city) {
            City::query()->updateOrCreate(
                ['slug' => $city['slug']],
                ['name' => $city['name']],
            );
        }
    }
}
