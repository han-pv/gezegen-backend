<?php

namespace Database\Seeders\Tickets;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tickets\Passenger;

class PassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passengers = [
            ['first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john.doe@example.com', 'phone' => '123-456-7890', 'passport_number' => 'II-AG91673'],
            ];
            
        foreach ($passengers as $passenger) {
                Passenger::create($passenger);
            }
    }

}
