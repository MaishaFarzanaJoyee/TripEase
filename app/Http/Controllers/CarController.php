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
    public function addToCart($carId)
    {
        $car = Car::findOrFail($carId);

        $cart = session()->get('car_cart', []);
        $cart[$carId] = $car;
        session()->put('car_cart', $cart);

        return redirect()->route('car.cart')->with('success', 'Car added to cart!');
    }

    // View cart
    public function viewCart()
    {
        $cart = session()->get('car_cart', []);
        return view('car.cart', compact('cart'));
    }
}

