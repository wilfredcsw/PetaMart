@extends('layouts.app', ['pageSlug' => 'Inventory'])

@section('content')
<div class="container">
    <h1>Product Interface
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">Add Product</button>
    </h1>
    

    <!-- Table to display products -->
    <table class="table">
        <thead>
            <tr>
                <th>Inventory ID</th>
                <th>Product ID</th>
                <th>Inventory Date</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through the products and display each row -->
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->inventory_id }}</td>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->inventory_date }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_description }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>{{ $product->total_price }}</td>
                    <td>d
                        <!-- Add buttons for edit and delete -->
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="inventory_id">Inventory ID:</label>
                        <input type="text" name="inventory_id" id="inventory_id" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="product_id">Product ID:</label>
                        <input type="text" name="product_id" id="product_id" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inventory_date">Inventory Date:</label>
                        <input type="date" name="inventory_date" id="inventory_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" id="product_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="product_description">Product Description:</label>
                        <textarea name="product_description" id="product_description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="product_price">Product Price:</label>
                        <input type="number" step="0.01" name="product_price" id="product_price" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="product_quantity">Product Quantity:</label>
                        <input type="number" name="product_quantity" id="product_quantity" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="total_price">Total Price:</label>
                        <input type="text" name="total_price" id="total_price" class="form-control" readonly>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="addProductForm" class="btn btn-primary">Add Product</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var productPriceInput = document.getElementById('product_price');
            var productQuantityInput = document.getElementById('product_quantity');
            var totalPriceInput = document.getElementById('total_price');

            productPriceInput.addEventListener('input', calculateTotalPrice);
            productQuantityInput.addEventListener('input', calculateTotalPrice);

            function calculateTotalPrice() {
                var price = parseFloat(productPriceInput.value) || 0;
                var quantity = parseInt(productQuantityInput.value) || 0;
                var totalPrice = price * quantity;

                totalPriceInput.value = totalPrice.toFixed(2);
            }
        });
    </script>
@endsection