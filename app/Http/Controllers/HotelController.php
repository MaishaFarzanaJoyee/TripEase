<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    // Search hotels by location, amenities, and price
    public function search(Request $request)
    {
        $query = Hotel::query();

        // Filter by location if provided
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by amenities if provided (optional)
        if ($request->filled('amenities')) {
            $query->where('amenities', 'like', '%' . $request->amenities . '%');
        }

        // Filter by minimum price if provided
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // Filter by maximum price if provided
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Execute the query and get the filtered hotels
        $hotels = $query->get();

        return view('hotel.search', compact('hotels'));
    }

    // Add hotel to cart
    public function addToCart($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);

        // Retrieve the cart from session or initialize it as an empty array
        $cart = session()->get('hotel_cart', []);

        // Add hotel to the cart
        $cart[$hotelId] = $hotel;
        session()->put('hotel_cart', $cart);

        return redirect()->route('hotel.cart')->with('success', 'Hotel added to cart!');
    }

    // View hotel cart
    public function viewCart()
    {
        $cart = session()->get('hotel_cart', []);
        return view('hotel.cart', compact('cart'));
    }
}
