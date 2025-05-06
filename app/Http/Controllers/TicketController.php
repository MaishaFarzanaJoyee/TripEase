<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Show all available tickets
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    // Add a ticket to the session cart
    public function addToCart(Request $request, Ticket $ticket)
    {
        $cart = session()->get('cart', []);
        $cart[$ticket->id] = $ticket;
        session(['cart' => $cart]);

        return redirect()->route('tickets.cart')->with('success', 'Ticket added to cart.');
    }

    // View cart contents
    public function viewCart()
    {
        $cart = session('cart', []);
        return view('tickets.cart', compact('cart'));
    }

    // Checkout (for now, just clear the cart)
    public function checkout()
    {
        session()->forget('cart');
        return redirect()->route('tickets.index')->with('success', 'Checkout complete!');
    }
}
