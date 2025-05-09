<h2>Cart</h2>

@if(session('hotel_cart') || session('car_cart'))
    <div>
        <h3>Hotel:</h3>
        @foreach(session('hotel_cart', []) as $hotel)
            <p>{{ $hotel->name }} - {{ $hotel->location }} - ${{ $hotel->price }}</p>
        @endforeach
    </div>

    <div>
        <h3>Cars:</h3>
        @foreach(session('car_cart', []) as $car)
            <p>{{ $car->name }} - {{ $car->location }} - ${{ $car->price }}</p>
        @endforeach
    </div>

    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <button type="submit">Proceed to Checkout</button>
    </form>
@else
    <p>Your cart is empty.</p>
@endif
