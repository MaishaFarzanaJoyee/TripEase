<!-- resources/views/tickets/cart.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart - TripEase</title>
</head>
<body>
    <h1>Your Cart</h1>

    @if(count($cart) === 0)
        <p>Your cart is empty.</p>
    @else
        <ul>
            @foreach($cart as $item)
                <li>
                    {{ $item['type'] }} from {{ $item['from_location'] }} to {{ $item['to_location'] }}
                    on {{ $item['departure_date'] }} at {{ $item['departure_time'] }} – ৳{{ number_format($item['price'], 2) }}
                </li>
            @endforeach
        </ul>

        <p><strong>Total:</strong> ৳{{ number_format($total, 2) }}</p>

        <form action="{{ route('tickets.checkout') }}" method="POST">
            @csrf
            <button type="submit">Checkout</button>
        </form>
    @endif

    <br>
    <a href="{{ route('tickets.index') }}">Back to Tickets</a>
</body>
</html>
