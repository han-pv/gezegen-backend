<?php

namespace Database\Seeders;

use App\Models\Ticket\Passenger;
// use Database\Factories\Ticket\PassengerFactory;
use Illuminate\Database\Seeder;

class PassengerSeeder extends Seeder
{
    public function run(): void
    {
        // PassengerFactory::new()->count(5)->create();

        Passenger::create([
            'full_name' => 'Jik hichj',
            'email' => 'jik@example.com',
            'phone' => '+15550199',
            'passport_number' => 'XY9876543',
        ]);

        Passenger::create([
            'full_name' => 'Merdan Gurbanov',
            'email' => 'merdan@example.com',
            'phone' => '+15550288',
            'passport_number' => 'AB1234567',
        ]);

        Passenger::create([
            'full_name' => 'Anna Smith',
            'email' => 'anna@example.com',
            'phone' => '+15550377',
            'passport_number' => 'CD7654321',
        ]);

        Passenger::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+15550466',
            'passport_number' => 'EF1122334',
        ]);
    }
}
