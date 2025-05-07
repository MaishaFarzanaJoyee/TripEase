<!DOCTYPE html>
<html>
<head>
    <title>Your Budget</title>
</head>
<body>
    <h1>Budget Overview</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if($budget)
        <p><strong>Total Budget:</strong> ৳{{ number_format($budget->amount, 2) }}</p>
        <p><strong>Total Spent:</strong> ৳{{ number_format($totalSpent, 2) }}</p>
        <p><strong>Remaining:</strong> ৳{{ number_format($remaining, 2) }}</p>
    @else
        <p>No budget set yet. <a href="{{ route('budget.create') }}">Set one now</a></p>
    @endif
</body>
</html>
