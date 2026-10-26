<?php

namespace Database\Seeders;

use App\Models\Ticket\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $airports = [
            [
                'name' => 'Aşgabat Halkara Howa Menzili',
                'code' => 'ASB',
                'city' => 'Aşgabat',
            ],
            [
                'name' => 'Türkmenabat Howa Menzili',
                'code' => 'CRZ',
                'city' => 'Türkmenabat',
            ],
            [
                'name' => 'Daşoguz Howa Menzili',
                'code' => 'TAZ',
                'city' => 'Daşoguz',
            ],
            [
                'name' => 'Mary Howa Menzili',
                'code' => 'MYP',
                'city' => 'Mary',
            ],
            [
                'name' => 'Türkmenbaşy Howa Menzili',
                'code' => 'KRW',
                'city' => 'Türkmenbaşy',
            ],
            [
                'name' => 'Stambul Howa Menzili',
                'code' => 'IST',
                'city' => 'Stambul',
            ],
            [
                'name' => 'Domodedowo Howa Menzili',
                'code' => 'DME',
                'city' => 'Moskwa',
            ],
            [
                'name' => 'Indira Gandhi Halkara Howa Menzili',
                'code' => 'DEL',
                'city' => 'Deli',
            ],
            [
                'name' => 'Frankfurt Howa Menzili',
                'code' => 'FRA',
                'city' => 'Frankfurt',
            ],
            [
                'name' => 'Suwarnabhumi Howa Menzili',
                'code' => 'BKK',
                'city' => 'Bangkok',
            ],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}