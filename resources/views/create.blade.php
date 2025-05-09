@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a Booking</h1>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tour_plan_id">Tour Plan</label>
            <select name="tour_plan_id" id="tour_plan_id" class="form-control" required>
                <option value="">Select a Tour Plan</option>
                @foreach($tourPlans as $tourPlan)
                    <option value="{{ $tourPlan->id }}">{{ $tourPlan->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Booking</button>
    </form>
</div>
@endsection
