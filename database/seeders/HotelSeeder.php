<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel; // Make sure to import the Hotel model

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::create([
            'name' => 'Hotel One',
            'location' => 'Paris',
            'price' => 150,
            'amenities' => 'Free Wi-Fi, Pool, Gym', // Add some amenities here
        ]);
    
        Hotel::create([
            'name' => 'Hotel Two',
            'location' => 'London',
            'price' => 200,
            'amenities' => 'Free Wi-Fi, Parking, Spa',
        ]);
    
        Hotel::create([
            'name' => 'Hotel Three',
            'location' => 'New York',
            'price' => 250,
            'amenities' => 'Free Wi-Fi, Restaurant, Bar',
        ]);
    
        Hotel::create([
            'name' => 'Hotel Four',
            'location' => 'Tokyo',
            'price' => 180,
            'amenities' => 'Free Wi-Fi, Karaoke, Spa',
        ]);
    
        Hotel::create([
            'name' => 'Hotel Five',
            'location' => 'Dubai',
            'price' => 300,
            'amenities' => 'Free Wi-Fi, Pool, Rooftop Bar',
        ]);
    }
    
}
