<?php

namespace Database\Seeders;

use App\Models\Ticket\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $airports = [
            ['name' => 'John F. Kennedy International Airport', 'city' => 'New York', 'code' => 'JFK'],
            ['name' => 'Los Angeles International Airport', 'city' => 'Los Angeles', 'code' => 'LAX'],
            ['name' => 'O\'Hare International Airport', 'city' => 'Chicago', 'code' => 'ORD'],
            ['name' => 'San Francisco International Airport', 'city' => 'San Francisco', 'code' => 'SFO'],
            ['name' => 'Miami International Airport', 'city' => 'Miami', 'code' => 'MIA'],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}