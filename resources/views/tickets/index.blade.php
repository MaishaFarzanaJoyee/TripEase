<!-- resources/views/tickets/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Available Tickets - TripEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Available Tickets</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Date</th>
                    <th>Departure Time</th>
                    <th>Price (৳)</th>
                    <th>Add to Cart</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->type }}</td>
                        <td>{{ $ticket->from_location }}</td>
                        <td>{{ $ticket->to_location }}</td>
                        <td>{{ $ticket->departure_date }}</td>
                        <td>{{ $ticket->departure_time }}</td>
                        <td>{{ number_format($ticket->price, 2) }}</td>
                        <td>
                            <form action="{{ route('tickets.addToCart', $ticket->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('tickets.cart') }}" class="btn btn-success">View Cart</a>
    </div>
</body>
</html>
