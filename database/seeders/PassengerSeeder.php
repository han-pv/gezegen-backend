<?php

namespace Database\Seeders;

use App\Models\Ticket\Passenger;
use Illuminate\Database\Seeder;

class PassengerSeeder extends Seeder
{
    public function run(): void
    {
        Passenger::factory()->count(5)->create();
    }
}