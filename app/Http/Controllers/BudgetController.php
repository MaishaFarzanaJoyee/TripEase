<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;


class BudgetController extends Controller
{
    public function create()
    {
        return view('budget.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        Budget::create([
            'amount' => $request->amount
        ]);

        return redirect()->route('budget.show')->with('success', 'Budget set successfully!');
    }


    public function show()
    {
        $budget = Budget::latest()->first(); // Assume one active budget
        $cart = session()->get('cart', []);
        $totalSpent = array_sum(array_column($cart, 'price'));
        $remaining = $budget ? $budget->amount - $totalSpent : 0;

        return view('budget.show', compact('budget', 'totalSpent', 'remaining'));
    }
}

