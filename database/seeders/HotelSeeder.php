<?php

namespace Database\Seeders;

use App\Models\Hotel\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        Hotel::factory(100)->create();
    }
}
