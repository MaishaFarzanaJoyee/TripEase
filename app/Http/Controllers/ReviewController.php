<?php

     namespace App\Http\Controllers;

     use App\Models\Activity;
     use App\Models\Bookmark;
     use App\Models\Destination;
     use App\Models\Review;
     use App\Models\UserPreference;
     use Illuminate\Http\Request;

     class ReviewController extends Controller
     {
         public function showReviews(Request $request)
         {
             $sessionId = $request->session()->getId();

             $selectedType = $request->input('reviewable_type', 'destination');
             $selectedId = $request->input('reviewable_id', Destination::first()->id ?? null);
             $reviews = [];
             if ($selectedId) {
                 $reviewableType = $selectedType === 'destination' ? Destination::class : Activity::class;
                 $reviews = Review::where('reviewable_type', $reviewableType)
                     ->where('reviewable_id', $selectedId)
                     ->get();
             }

             // Data for other sections
             $preference = UserPreference::where('session_id', $sessionId)->first();
             $bookmarks = Bookmark::where('session_id', $sessionId)->with('destination')->get();
             $destinations = Destination::all();
             $activities = Activity::all();
             $recommendedDestinations = Destination::where('average_rating', '>=', 4)->orderBy('average_rating', 'desc')->get();
             $recommendedActivities = Activity::where('average_rating', '>=', 4)->orderBy('average_rating', 'desc')->get();

             return view('home', compact(
                 'reviews',
                 'selectedType',
                 'selectedId',
                 'preference',
                 'bookmarks',
                 'destinations',
                 'activities',
                 'recommendedDestinations',
                 'recommendedActivities'
             ));
         }

         public function postReview(Request $request)
         {
             $request->validate([
                 'reviewable_type' => 'required|in:destination,activity',
                 'reviewable_id' => 'required|numeric',
                 'rating' => 'required|integer|min:1|max:5',
                 'comment' => 'nullable|string',
             ]);

             $reviewableType = $request->reviewable_type === 'destination' ? Destination::class : Activity::class;
             $reviewable = $reviewableType::find($request->reviewable_id);

             if (!$reviewable) {
                 return redirect()->route('home')->with('error', 'Invalid destination or activity.');
             }

             $review = Review::create([
                 'reviewable_id' => $request->reviewable_id,
                 'reviewable_type' => $reviewableType,
                 'rating' => $request->rating,
                 'comment' => $request->comment,
             ]);

             $averageRating = $reviewable->reviews()->avg('rating');
             $reviewable->average_rating = round($averageRating, 2);
             $reviewable->save();

             return redirect()->route('home', [
                 'reviewable_type' => $request->reviewable_type,
                 'reviewable_id' => $request->reviewable_id
             ])->with('success', 'Review posted successfully.');
         }
     }