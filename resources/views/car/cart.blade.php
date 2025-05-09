<!-- resources/views/car/cart.blade.php -->
<h2>Car Cart</h2>

@if(session('car_cart'))
    @foreach(session('car_cart') as $car)
        <p>{{ $car->name }} - {{ $car->location }} - ${{ $car->price }}</p>
    @endforeach
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <button type="submit">Proceed to Checkout</button>
    </form>
@else
    <p>Your cart is empty.</p>
@endif
