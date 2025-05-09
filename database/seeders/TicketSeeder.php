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
        
        Ticket::create([
            'type' => 'Flight',
            'from_location' => 'Dhaka',
            'to_location' => 'Chattogram',
            'departure_date' => '2025-06-01',
            'departure_time' => '09:00:00',
            'price' => 4500.00,
        ]);

        Ticket::create([
            'type' => 'Train',
            'from_location' => 'Dhaka',
            'to_location' => 'Rajshahi',
            'departure_date' => '2025-06-02',
            'departure_time' => '13:30:00',
            'price' => 1200.00,
        ]);
    }
}




