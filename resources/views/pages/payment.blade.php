@extends('layouts.app', ['pageSlug' => 'Payment'])

@section('content')
<div class="container">
    <h1>Product List
    </h1>
    

    <!-- Table to display products -->
    <table class="table">

        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        

        <tbody>
            <!-- Loop through the products and display each row -->
            @foreach($payments as $Payment)
                <tr>

                    <td>{{ $Payment->ProductName }}</td>
                    <td>{{ $Payment->ProductPrice }}</td>
                    <td>{{ $Payment->ProductQuantity }}</td>
                    <td>{{ $Payment->TotalPrice }}</td>

                </tr>
                @endforeach
        </tbody>
        

    </table>
</div> 
@endsection
