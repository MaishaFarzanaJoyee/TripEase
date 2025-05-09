<h1>Search Cars</h1>

<form action="{{ route('cars.search') }}" method="GET">
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

@if ($cars->isEmpty())
    <p>No cars found based on your search criteria.</p>
@else
    <ul>
@foreach ($cars as $car)
    <li>
        <h3>{{ $car->model }} - {{ $car->make }}</h3>
        <p>Location: {{ $car->location }}</p>
        <p>Price: ${{ $car->price_per_day }}</p>

        @foreach ($cars as $car)
    <h3>{{ $car->model }} - {{ $car->make }}</h3>
    <p>Location: {{ $car->location }}</p>
    <p>Price: ${{ $car->price_per_day }}</p>

    <form action="{{ route('cart.add', ['hotel_id' => session('hotel_cart')[0]['id'] ?? null, 'car_id' => $car->id]) }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Add Car to Cart</button>
    </form>
@endforeach

    </li>
@endforeach

    </ul>
@endif

