<?php

namespace Database\Seeders;

use App\Models\Tickets\Flight;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        Flight::factory(30)->create();
    }
}
