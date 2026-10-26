<?php

namespace Database\Seeders;

use App\Models\Tickets\Passenger;
use Illuminate\Database\Seeder;

class PassengerSeeder extends Seeder
{
    public function run(): void
    {
        Passenger::factory(50)->create();
    }
}
