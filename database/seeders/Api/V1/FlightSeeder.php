<?php

namespace Database\Seeders\Api\V1;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Api\V1\Flight;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flights=[
            ['from_city_id' => 1, 'to_city_id' => 2, 'from_time' => '08:00:00', 'to_time' => '11:00:00',  'code' => 'AA101', 'airlines' => 'American Airlines'],
            ['from_city_id' => 2, 'to_city_id' => 3, 'from_time' => '09:00:00', 'to_time' => '12:00:00',  'code' => 'DL202', 'airlines' => 'Delta Airlines'],
            ['from_city_id' => 3, 'to_city_id' => 4, 'from_time' => '10:00:00', 'to_time' => '13:00:00',  'code' => 'UA303', 'airlines' => 'United Airlines'],
            ['from_city_id' => 4, 'to_city_id' => 5, 'from_time' => '11:00:00', 'to_time' => '14:00:00',  'code' => 'SW404', 'airlines' => 'Southwest Airlines'],
            ['from_city_id' => 5, 'to_city_id' => 6, 'from_time' => '12:00:00', 'to_time' => '15:00:00',  'code' => 'BA505', 'airlines' => 'British Airways'],
            ['from_city_id' => 6, 'to_city_id' => 7, 'from_time' => '13:00:00', 'to_time' => '16:00:00',  'code' => 'AF606', 'airlines' => 'Air France'],
            ['from_city_id' => 7, 'to_city_id' => 8, 'from_time' => '14:00:00', 'to_time' => '17:00:00',  'code' => 'LH707', 'airlines' => 'Lufthansa'],
            ['from_city_id' => 8, 'to_city_id' => 9, 'from_time' => '15:00:00', 'to_time' => '18:00:00',  'code' => 'EK808', 'airlines' => 'Emirates'],
            ['from_city_id' => 9, 'to_city_id' => 10, 'from_time' => '16:00:00', 'to_time' => '19:00:00',  'code' => 'QF909', 'airlines' => 'Qantas'],
            ['from_city_id' => 10, 'to_city_id' => 1, 'from_time' => '17:00:00', 'to_time' => '20:00:00',  'code' => 'SQ010', 'airlines' => 'Singapore Airlines'],
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}
