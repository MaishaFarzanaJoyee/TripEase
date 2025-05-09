<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TouristSpot;

class TouristSpotController extends Controller
{
    /**
     * Display a listing of tourist spots, with optional filters.
     */
    public function index(Request $request)
    {
        // Fetch filter values if provided
        $season = $request->input('season');
        $hype = $request->input('hype');

        // Build the query
        $query = TouristSpot::query();

        if ($season) {
            $query->where('season', $season);
        }

        if ($hype) {
            $query->where('hype_level', '>=', $hype);
        }

        $spots = $query->get();

        return view('tourist-spots.index', compact('spots', 'season', 'hype'));
    }
}
