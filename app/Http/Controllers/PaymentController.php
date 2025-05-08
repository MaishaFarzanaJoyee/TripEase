<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = \Stripe\Charge::create([
            'amount' => $request->input('amount'),
            'currency' => 'usd',
            'source' => $request->input('stripeToken'),
        ]);

        // Process booking after successful payment
        return redirect()->route('booking.success');
    }
}
