<?php

namespace Database\Seeders;

use App\Models\Ticket\Airport;
// use Database\Factories\Ticket\AirportFactory;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        // AirportFactory::new()->count(5)->create();

        Airport::create([
            'name' => 'John F. Kennedy International Airport',
            'code' => 'JFK',
            'city' => 'New York',
            'country' => 'USA',
        ]);

        Airport::create([
            'name' => 'Los Angeles International Airport',
            'code' => 'LAX',
            'city' => 'Los Angeles',
            'country' => 'USA',
        ]);

        Airport::create([
            'name' => 'O\'Hare International Airport',
            'code' => 'ORD',
            'city' => 'Chicago',
            'country' => 'USA',
        ]);

        Airport::create([
            'name' => 'Heathrow Airport',
            'code' => 'LHR',
            'city' => 'London',
            'country' => 'UK',
        ]);

        Airport::create([
            'name' => 'San Francisco International Airport',
            'code' => 'SFO',
            'city' => 'San Francisco',
            'country' => 'USA',
        ]);
    }
}
