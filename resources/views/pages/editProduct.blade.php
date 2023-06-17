@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="inventory_date">Inventory Date</label>
                <input type="date" class="form-control" id="inventory_date" name="inventory_date" value="{{ $product->inventory_date }}">
            </div>

            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}">
            </div>

            <div class="form-group">
                <label for="product_desc">Product Description</label>
                <textarea class="form-control" id="product_desc" name="product_desc">{{ $product->product_desc }}</textarea>
            </div>

            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" value="{{ $product->product_price }}">
            </div>

            <div class="form-group">
                <label for="product_quantity">Product Quantity</label>
                <input type="number" class="form-control" id="product_quantity" name="product_quantity" value="{{ $product->product_quantity }}">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
