<?php

namespace Database\Seeders;

use App\Models\Hotel\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::factory(300)->create();
    }
}
