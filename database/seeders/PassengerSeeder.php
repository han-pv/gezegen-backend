<?php

namespace Database\Seeders;

use App\Models\Ticket\Passenger;
use Illuminate\Database\Seeder;

class PassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passengers = [
            [
                'full_name' => 'Aman Berdiýew',
                'email' => 'aman@mail.com',
                'phone' => '+99365123456',
            ],
            [
                'full_name' => 'Berdi Amanow',
                'email' => 'berdi@mail.com',
                'phone' => '+99361123456',
            ],
            [
                'full_name' => 'Han Pirliýew',
                'email' => 'han@mail.com',
                'phone' => '+99363684577',
            ],
            [
                'full_name' => 'Aly Rahmanow',
                'email' => 'aly@mail.com',
                'phone' => '+99362123456',
            ],
            [
                'full_name' => 'Kerem Serdarow',
                'email' => 'gadayhan@mail.com',
                'phone' => '+99361586807',
            ],
            [
                'full_name' => 'Jeren Penaýewa',
                'email' => 'jeren@mail.com',
                'phone' => '+99363123456',
            ],
        ];

        foreach ($passengers as $passenger) {
            Passenger::create($passenger);
        }
    }
}
