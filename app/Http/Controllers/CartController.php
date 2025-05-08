<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Car;

class CartController extends Controller
{
    public function addToCart(Request $request, $hotel_id, $car_id)
    {
        $hotel = Hotel::findOrFail($hotel_id);
        $car = Car::findOrFail($car_id);

        $cart = session()->get('cart', []);
        $cart[] = ['hotel' => $hotel, 'car' => $car];
        session()->put('cart', $cart);

        return redirect()->route('cart.view');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.view', compact('cart'));
    }
}
