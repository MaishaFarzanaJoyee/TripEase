<!-- resources/views/hotel/cart.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
</head>
<body>
    <h1>Your Cart</h1>

    @if(session('hotel_cart'))
        <ul>
            @foreach(session('hotel_cart') as $hotelId => $hotel)
                <li>
                    <h3>{{ $hotel->name }}</h3>
                    <p>Location: {{ $hotel->location }}</p>
                    <p>Price: ${{ $hotel->price }}</p>
                    <p>Amenities: {{ $hotel->amenities ?? 'N/A' }}</p>
                    <form action="{{ route('cart.remove', $hotelId) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove from Cart</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button type="submit">Proceed to Checkout</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
</body>
</html>
