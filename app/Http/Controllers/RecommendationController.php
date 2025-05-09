<?php

     namespace App\Http\Controllers;

     use App\Models\Activity;
     use App\Models\Bookmark;
     use App\Models\Destination;
     use App\Models\UserPreference;
     use Illuminate\Http\Request;

     class RecommendationController extends Controller
     {
         public function showRecommendations(Request $request)
         {
             $sessionId = $request->session()->getId();

             $bookmarkedDestinationIds = Bookmark::where('session_id', $sessionId)->pluck('destination_id');

             $preference = UserPreference::where('session_id', $sessionId)->first();

             // Get destinations
             $destinationsQuery = Destination::query();
             if ($bookmarkedDestinationIds->isNotEmpty()) {
                 $destinationsQuery->whereIn('id', $bookmarkedDestinationIds);
             }
             $destinationsQuery->orWhere('average_rating', '>=', 4);
             $recommendedDestinations = $destinationsQuery->orderBy('average_rating', 'desc')->get();

             // Get activities within budget
             $activitiesQuery = Activity::query();
             if ($bookmarkedDestinationIds->isNotEmpty()) {
                 $activitiesQuery->whereIn('destination_id', $bookmarkedDestinationIds);
             }
             $activitiesQuery->orWhere('average_rating', '>=', 4);

             if ($preference && $preference->min_budget && $preference->max_budget) {
                 $activitiesQuery->whereBetween('price', [$preference->min_budget, $preference->max_budget]);
             }
             $recommendedActivities = $activitiesQuery->orderBy('average_rating', 'desc')->get();

             // Pass additional data for other sections
             $preference = UserPreference::where('session_id', $sessionId)->first();
             $bookmarks = Bookmark::where('session_id', $sessionId)->with('destination')->get();
             $destinations = Destination::all();
             $activities = Activity::all();

             return view('home', compact(
                 'recommendedDestinations',
                 'recommendedActivities',
                 'preference',
                 'bookmarks',
                 'destinations',
                 'activities'
             ));
         }
     }