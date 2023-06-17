@extends('layouts.app', ['pageSlug' => 'Sales'])

@section('content')
<div class="container">
    <h1>Sales
    </h1>

    <table class="table">
        <thead>
            <tr>
                <th>Checkout ID</th>
                <th>Checkout Date</th>
                <th>Checkout Time</th>
                <th>User ID</th>
                <th>Total Cost</th>
                <th>Payment Type</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through the products and display each row -->
            @foreach($sales as $sale)
                <tr>
                <td>{{ $sale->checkout_id }}</td>
                <td>{{ $sale->checkout_date }}</td>
                <td>{{ $sale->checkout_time }}</td>
                <td>{{ $sale->user_id }}</td>
                <td>{{ $sale->total_cost }}</td>
                <td>{{ $sale->payment_type }}</td>
                <td>{{ $sale->payment_status }}</td>
                </tr>
            @endforeach
        </tbody>
</div>


@endsection
