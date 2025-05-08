
<!-- resources/views/hotel/search.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Search</title>
</head>
<body>
    <!-- Hotel Search Form -->
    <h1>Search Hotels</h1>

    <form action="{{ route('hotels.search') }}" method="GET">
        <div>
            <label for="location">Location</label>
            <input type="text" name="location" id="location" placeholder="Location" value="{{ request('location') }}">
        </div>

        <div>
            <label for="price_min">Min Price</label>
            <input type="number" name="price_min" id="price_min" placeholder="Min Price" value="{{ request('price_min') }}">
        </div>

        <div>
            <label for="price_max">Max Price</label>
            <input type="number" name="price_max" id="price_max" placeholder="Max Price" value="{{ request('price_max') }}">
        </div>

        <button type="submit">Search</button>
    </form>

    <!-- Display Search Results -->
    <h2>Search Results</h2>

    @if ($hotels->isEmpty())
        <p>No hotels found based on your search criteria.</p>
    @else
        <ul>
            @foreach ($hotels as $hotel)
                <li>
                    <h3>{{ $hotel->name }}</h3>
                    <p>Location: {{ $hotel->location }}</p>
                    <p>Price: ${{ $hotel->price }}</p>
                    <p>Amenities: {{ $hotel->amenities ?? 'N/A' }}</p>
                    <a href="{{ route('cart.add', ['hotel_id' => $hotel->id]) }}">Add to Cart</a>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
