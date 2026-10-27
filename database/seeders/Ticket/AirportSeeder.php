<?php

namespace Database\Seeders\Ticket;

use App\Models\Hotel\City;
use App\Models\Ticket\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newYork = City::where('name', 'New York')->first();
        $losAngeles = City::where('name', 'Los Angeles')->first();
        $chicago = City::where('name', 'Chicago')->first();
        $miami = City::where('name', 'Miami')->first();
        $sanFrancisco = City::where('name', 'San Francisco')->first();
        $lasVegas = City::where('name', 'Las Vegas')->first();
        $seattle = City::where('name', 'Seattle')->first();
        $boston = City::where('name', 'Boston')->first();

        $airports = [
            [
                'name' => 'John F. Kennedy International',
                'code' => 'JFK',
                'city_id' => $newYork?->id
            ],
            [
                'name' => 'Los Angeles International',
                'code' => 'LAX',
                'city_id' => $losAngeles?->id
            ],
            [
                'name' => 'Chicago O Hare International',
                'code' => 'ORD',
                'city_id' => $chicago?->id
            ],
            [
                'name' => 'Miami International',
                'code' => 'MIA',
                'city_id' => $miami?->id
            ],
            [
                'name' => 'San Francisco International',
                'code' => 'SFO',
                'city_id' => $sanFrancisco?->id
            ],
            [
                'name' => 'Harry Reid International',
                'code' => 'LAS',
                'city_id' => $lasVegas?->id
            ],
            [
                'name' => 'Seattle-Tacoma International',
                'code' => 'SEA',
                'city_id' => $seattle?->id
            ],
            [
                'name' => 'Logan International',
                'code' => 'BOS',
                'city_id' => $boston?->id
            ],
        ];

        foreach ($airports as $airport) {
            if ($airport['city_id']) {
                Airport::create($airport);
            }
        }
    }
}
