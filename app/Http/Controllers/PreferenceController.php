<?php

     namespace App\Http\Controllers;

     use App\Models\Bookmark;
     use App\Models\Destination;
     use App\Models\UserPreference;
     use Illuminate\Http\Request;

     class PreferenceController extends Controller
     {
         public function showPreferences(Request $request)
         {
             $sessionId = $request->session()->getId();
             $preference = UserPreference::where('session_id', $sessionId)->first();
             $bookmarks = Bookmark::where('session_id', $sessionId)->with('destination')->get();
             $destinations = Destination::all();

             return view('home', compact('preference', 'bookmarks', 'destinations'));
         }

         public function setBudget(Request $request)
         {
             $request->validate([
                 'min_budget' => 'required|numeric|min:0',
                 'max_budget' => 'required|numeric|gte:min_budget',
             ]);

             $sessionId = $request->session()->getId();

             $preference = UserPreference::updateOrCreate(
                 ['session_id' => $sessionId],
                 [
                     'min_budget' => $request->min_budget,
                     'max_budget' => $request->max_budget,
                 ]
             );

             return redirect()->route('home')->with('success', 'Budget updated successfully.');
         }

         public function addBookmark(Request $request)
         {
             $request->validate([
                 'destination_id' => 'required|exists:destinations,id',
             ]);

             $sessionId = $request->session()->getId();

             Bookmark::create([
                 'session_id' => $sessionId,
                 'destination_id' => $request->destination_id,
             ]);

             return redirect()->route('home')->with('success', 'Bookmark added successfully.');
         }

         public function removeBookmark(Request $request)
         {
             $request->validate([
                 'destination_id' => 'required|exists:destinations,id',
             ]);

             $sessionId = $request->session()->getId();

             $bookmark = Bookmark::where('session_id', $sessionId)
                 ->where('destination_id', $request->destination_id)
                 ->first();

             if ($bookmark) {
                 $bookmark->delete();
                 return redirect()->route('home')->with('success', 'Bookmark removed successfully.');
             }

             return redirect()->route('home')->with('error', 'Bookmark not found.');
         }
     }