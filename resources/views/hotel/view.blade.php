
<h1>Your Cart</h1>
@foreach($cart as $item)
    <p>Hotel: {{ $item['hotel']->name }} - Car: {{ $item['car']->model }}</p>
@endforeach

