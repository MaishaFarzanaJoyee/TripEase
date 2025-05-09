<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        Car::create([
            'model' => 'Civic',
            'make' => 'Honda',
            'location' => 'Paris',
            'type' => 'Sedan',
            'brand' => 'Honda',
            'price_per_day' => 80,
        ]);

        Car::create([
            'model' => 'Corolla',
            'make' => 'Toyota',
            'location' => 'London',
            'type' => 'Sedan',
            'brand' => 'Toyota',
            'price_per_day' => 70,
        ]);
    }
}
