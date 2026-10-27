<?php

namespace Database\Seeders\Ticket;

use App\Models\Hotel\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'New York', 'slug' => 'new-york'],
            ['name' => 'Los Angeles', 'slug' => 'los-angeles'],
            ['name' => 'Chicago', 'slug' => 'chicago'],
            ['name' => 'Miami', 'slug' => 'miami'],
            ['name' => 'San Francisco', 'slug' => 'san-francisco'],
            ['name' => 'Las Vegas', 'slug' => 'las-vegas'],
            ['name' => 'Seattle', 'slug' => 'seattle'],
            ['name' => 'Boston', 'slug' => 'boston'],
        ];

        foreach ($cities as $city) {
            City::query()->updateOrCreate(
                ['slug' => $city['slug']],
                ['name' => $city['name']]
            );
        }
    }
}
