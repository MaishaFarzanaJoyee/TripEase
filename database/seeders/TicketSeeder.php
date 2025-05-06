<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Ticket::create([
            'type' => 'Flight',
            'from_location' => 'Dhaka',
            'to_location' => 'Cox’s Bazar',
            'departure_date' => '2025-05-20',
            'departure_time' => '10:00:00',
            'price' => 5000.00,
        ]);
    }
}
