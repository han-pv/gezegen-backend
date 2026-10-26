<?php

namespace Database\Seeders;

use App\Models\Tickets\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        Ticket::factory(100)->create();
    }
}
