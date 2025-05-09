namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run()
    {
        Car::create([
            'make' => 'Toyota',
            'model' => 'Camry',
            'location' => 'Paris',
            'price' => 50,
        ]);
        
        Car::create([
            'make' => 'Honda',
            'model' => 'Civic',
            'location' => 'Paris',
            'price' => 45,
        ]);
        
        Car::create([
            'make' => 'BMW',
            'model' => '5 Series',
            'location' => 'New York',
            'price' => 150,
        ]);
    }
}
