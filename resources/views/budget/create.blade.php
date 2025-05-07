<!-- resources/views/budget/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Set Budget</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2>Set Your Budget</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('budget.store') }}">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Budget Amount (৳):</label>
                <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Budget</button>
        </form>
    </div>
</body>
</html>
