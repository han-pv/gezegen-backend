<?php

namespace Database\Seeders;

use App\Models\Ticket\Flight;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        Flight::factory()->count(35)->create();
    }
}
