<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    // Search available cars based on filters
    public function search(Request $request)
    {
        $query = Car::query();

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->type . '%');
        }

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        if ($request->filled('price_min')) {
            $query->where('price_per_day', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price_per_day', '<=', $request->price_max);
        }

        $cars = $query->get();

        return view('car.search', compact('cars'));
    }

    // Add car to cart
public function addToCart($hotel_id, $car_id)
    {
        // Get car and hotel details
        $car = Car::findOrFail($car_id);
        $hotel = Hotel::findOrFail($hotel_id);

        // Get the cart from session
        $carCart = session()->get('car_cart', []);
        
        // Add car to the cart
        $carCart[] = $car;
        session()->put('car_cart', $carCart);

        // Add hotel to the cart if not already
        if(!session()->has('hotel_cart')) {
            session()->put('hotel_cart', [$hotel]);
        }

        return redirect()->route('cart.view')->with('success', 'Car added to cart!');
    }

    // View the cart
    public function viewCart()
    {
        return view('cart.view'); // Displays the cart view
    }
}




