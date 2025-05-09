@extends('layouts.app')

     @section('content')
         <h1 class="text-3xl font-bold mb-6">Travel Review Dashboard</h1>

         <!-- Tabs for Sections -->
         <div class="mb-6">
             <a href="{{ route('preferences') }}" class="bg-blue-600 text-white px-4 py-2 rounded mr-2">Preferences</a>
             <a href="{{ route('recommendations') }}" class="bg-blue-600 text-white px-4 py-2 rounded mr-2">Recommendations</a>
             <a href="{{ route('reviews') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Reviews</a>
         </div>

         <!-- Preferences Section -->
         <div id="preferences" class="section-content bg-white p-6 rounded shadow mb-6">
             <h2 class="text-xl font-semibold mb-4">Manage Preferences</h2>

             <!-- Set Budget Form -->
             <div class="mb-6">
                 <h3 class="text-lg font-medium mb-2">Set Budget</h3>
                 <form action="{{ route('preferences.budget') }}" method="POST">
                     @csrf
                     <div class="mb-4">
                         <label for="min_budget" class="block text-sm font-medium">Minimum Budget</label>
                         <input type="number" name="min_budget" id="min_budget" value="{{ $preference->min_budget ?? '' }}" class="border p-2 w-full rounded" required>
                     </div>
                     <div class="mb-4">
                         <label for="max_budget" class="block text-sm font-medium">Maximum Budget</label>
                         <input type="number" name="max_budget" id="max_budget" value="{{ $preference->max_budget ?? '' }}" class="border p-2 w-full rounded" required>
                     </div>
                     <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Budget</button>
                 </form>
             </div>

             <!-- Add Bookmark Form -->
             <div class="mb-6">
                 <h3 class="text-lg font-medium mb-2">Add Bookmark</h3>
                 <form action="{{ route('preferences.bookmark.add') }}" method="POST">
                     @csrf
                     <div class="mb-4">
                         <label for="destination_id" class="block text-sm font-medium">Destination</label>
                         <select name="destination_id" id="destination_id" class="border p-2 w-full rounded" required>
                             @foreach ($destinations as $destination)
                                 <option value="{{ $destination->id }}">{{ $destination->name }} ({{ $destination->location }})</option>
                             @endforeach
                         </select>
                     </div>
                     <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Bookmark</button>
                 </form>
             </div>

             <!-- Bookmarks List -->
             <div>
                 <h3 class="text-lg font-medium mb-2">Your Bookmarks</h3>
                 @if ($bookmarks->isEmpty())
                     <p>No bookmarks added.</p>
                 @else
                     <ul class="list-disc pl-5">
                         @foreach ($bookmarks as $bookmark)
                             <li class="mb-2">
                                 {{ $bookmark->destination->name }} ({{ $bookmark->destination->location }})
                                 <form action="{{ route('preferences.bookmark.remove') }}" method="POST" class="inline">
                                     @csrf
                                     <input type="hidden" name="destination_id" value="{{ $bookmark->destination_id }}">
                                     <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                 </form>
                             </li>
                         @endforeach
                     </ul>
                 @endif
             </div>
         </div>

         <!-- Recommendations Section -->
         <div id="recommendations" class="section-content bg-white p-6 rounded shadow mb-6 hidden">
             <h2 class="text-xl font-semibold mb-4">Recommended Destinations & Activities</h2>

             <!-- Destinations -->
             <div class="mb-6">
                 <h3 class="text-lg font-medium mb-2">Destinations</h3>
                 @if ($recommendedDestinations->isEmpty())
                     <p>No destinations recommended.</p>
                 @else
                     <ul class="list-disc pl-5">
                         @foreach ($recommendedDestinations as $destination)
                             <li class="mb-2">
                                 {{ $destination->name }} ({{ $destination->location }}) - Rating: {{ $destination->average_rating }}
                             </li>
                         @endforeach
                     </ul>
                 @endif
             </div>

             <!-- Activities -->
             <div>
                 <h3 class="text-lg font-medium mb-2">Activities</h3>
                 @if ($recommendedActivities->isEmpty())
                     <p>No activities recommended.</p>
                 @else
                     <ul class="list-disc pl-5">
                         @foreach ($recommendedActivities as $activity)
                             <li class="mb-2">
                                 {{ $activity->name }} (Price: ${{ $activity->price }}) - Rating: {{ $activity->average_rating }}
                             </li>
                         @endforeach
                     </ul>
                 @endif
             </div>
         </div>

         <!-- Reviews Section -->
         <div id="reviews" class="section-content bg-white p-6 rounded shadow hidden">
             <h2 class="text-xl font-semibold mb-4">Reviews</h2>

             <!-- Select Reviewable -->
             <div class="mb-6">
                 <h3 class="text-lg font-medium mb-2">Select Destination or Activity</h3>
                 <form id="review-select-form" action="{{ route('reviews') }}" method="GET">
                     <div class="mb-4">
                         <label for="reviewable_type" class="block text-sm font-medium">Type</label>
                         <select name="reviewable_type" id="reviewable_type" class="border p-2 w-full rounded" onchange="document.getElementById('review-select-form').submit()">
                             <option value="destination" {{ $selectedType === 'destination' ? 'selected' : '' }}>Destination</option>
                             <option value="activity" {{ $selectedType === 'activity' ? 'selected' : '' }}>Activity</option>
                         </select>
                     </div>
                     <div class="mb-4">
                         <label for="reviewable_id" class="block text-sm font-medium">Item</label>
                         <select name="reviewable_id" id="reviewable_id" class="border p-2 w-full rounded" onchange="document.getElementById('review-select-form').submit()">
                             @if ($selectedType === 'destination')
                                 @foreach ($destinations as $destination)
                                     <option value="{{ $destination->id }}" {{ $selectedId == $destination->id ? 'selected' : '' }}>
                                         {{ $destination->name }} ({{ $destination->location }})
                                     </option>
                                 @endforeach
                             @else
                                 @foreach ($activities as $activity)
                                     <option value="{{ $activity->id }}" {{ $selectedId == $activity->id ? 'selected' : '' }}>
                                         {{ $activity->name }}
                                     </option>
                                 @endforeach
                             @endif
                         </select>
                     </div>
                 </form>
             </div>

             <!-- Post Review Form -->
             <div class="mb-6">
                 <h3 class="text-lg font-medium mb-2">Add a Review</h3>
                 <form action="{{ route('reviews.store') }}" method="POST">
                     @csrf
                     <input type="hidden" name="reviewable_type" value="{{ $selectedType }}">
                     <input type="hidden" name="reviewable_id" value="{{ $selectedId }}">
                     <div class="mb-4">
                         <label for="rating" class="block text-sm font-medium">Rating (1-5)</label>
                         <input type="number" name="rating" id="rating" min="1" max="5" class="border p-2 w-full rounded" required>
                     </div>
                     <div class="mb-4">
                         <label for="comment" class="block text-sm font-medium">Comment</label>
                         <textarea name="comment" id="comment" class="border p-2 w-full rounded"></textarea>
                     </div>
                     <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit Review</button>
                 </form>
             </div>

             <!-- Reviews List -->
             <div>
                 <h3 class="text-lg font-medium mb-2">Reviews</h3>
                 @if ($reviews->isEmpty())
                     <p>No reviews yet.</p>
                 @else
                     <ul class="list-disc pl-5">
                         @foreach ($reviews as $review)
                             <li class="mb-2">
                                 Rating: {{ $review->rating }}/5
                                 @if ($review->comment)
                                     - {{ $review->comment }}
                                 @endif
                             </li>
                         @endforeach
                     </ul>
                 @endif
             </div>
         </div>

         <script>
             // Show preferences section by default
             document.getElementById('preferences').classList.remove('hidden');
         </script>
     @endsection