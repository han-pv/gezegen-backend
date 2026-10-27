<?php

namespace Database\Seeders\Tickets;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Tickets\Airport;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airports = [
            ['code' => 'JFK', 'name' => 'John F. Kennedy International Airport', 'city_id' => 1],
            ['code' => 'LAX', 'name' => 'Los Angeles International Airport', 'city_id' => 2],
            ['code' => 'ORD', 'name' => "O'Hare International Airport", 'city_id' => 3],
            ['code' => 'ATL', 'name' => 'Hartsfield-Jackson Atlanta International Airport', 'city_id' => 4],
            ['code' => 'DFW', 'name' => 'Dallas/Fort Worth International Airport', 'city_id' => 5],
            ['code' => 'DEN', 'name' => 'Denver International Airport', 'city_id' => 6],
            ['code' => 'SFO', 'name' => 'San Francisco International Airport', 'city_id' => 7],
            ['code' => 'SEA', 'name' => 'Seattle-Tacoma International Airport', 'city_id' => 8],
            ['code' => 'MIA', 'name' => 'Miami International Airport', 'city_id' => 9],
            ['code' => 'BOS', 'name' => 'Logan International Airport', 'city_id' => 10],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}
