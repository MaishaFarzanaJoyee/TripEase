<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TourPlan;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all bookings for the authenticated user
        $bookings = Booking::where('user_id', auth()->id())->get(); 
        return view('bookings.index', compact('bookings')); // Send the bookings to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all tour plans available to book
        $tourPlans = TourPlan::all();
        return view('bookings.create', compact('tourPlans')); // Send the tour plans to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input fields
        $request->validate([
            'tour_plan_id' => 'required|exists:tour_plans,id', // Validate tour plan ID
            'start_date' => 'required|date', // Validate start date
            'end_date' => 'required|date|after:start_date', // Validate end date (must be after start date)
        ]);

        // Create the booking
        Booking::create([
            'user_id' => auth()->id(), // Store the authenticated user's ID
            'tour_plan_id' => $request->tour_plan_id, // Store the selected tour plan
            'start_date' => $request->start_date, // Store the start date
            'end_date' => $request->end_date, // Store the end date
        ]);

        // Redirect to the bookings index with a success message
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        // This can be used to show details of a specific booking if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        // This can be used to show the edit form for a booking if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // This can be used to update a booking if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // This can be used to delete a booking if needed
    }
}
