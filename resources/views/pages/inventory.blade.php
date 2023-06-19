@extends('layouts.app', ['pageSlug' => 'Inventory'])

@section('content')
<div class="container">
    <h1>List of Products
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">Add Product</button>
    </h1>
    

    <!-- Table to display products -->
    <table class="table">
        <thead>
            <tr>
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
                    <td class="tbl-product-id">{{ $product->ProductID }}</td>
                    <td class="tbl-inventory-date">{{ $product->InventoryDate }}</td>
                    <td class="tbl-product-name">{{ $product->ProductName }}</td>
                    <td class="tbl-product-desc">{{ $product->ProductDesc }}</td>
                    <td class="tbl-product-price">{{ $product->ProductPrice }}</td>
                    <td class="tbl-product-quantity">{{ $product->ProductQuantity }}</td>
                    <td>{{ $product->TotalPrice }}</td>
                    <td>
                        <!-- Add buttons for edit and delete -->
                        {{-- <form method="GET" style="display: inline;" action="{{ route('products.edit', ['product' => $product->ProductID]) }}">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-primary edit-btn">Edit</button>
                        </form> --}}
                        <button class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editProductModal" data-product-id="{{ $product->ProductID }}" onclick="{{ $selectedProduct = $product->ProductID }}">Edit</button>
                        <form method="POST" style="display: inline;" action="{{ route('products.destroy', ['product' => $product->ProductID]) }}">
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
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="InventoryDate">Inventory Date:</label>
                        <input type="date" name="InventoryDate" id="InventoryDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ProductName">Product Name:</label>
                        <input type="text" name="ProductName" id="ProductName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ProductDesc">Product Description:</label>
                        <textarea name="ProductDesc" id="ProductDesc" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ProductPrice">Product Price:</label>
                        <input type="number" step="0.01" name="ProductPrice" id="ProductPrice" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ProductQuantity">Product Quantity:</label>
                        <input type="number" name="ProductQuantity" id="ProductQuantity" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" action="{{ route('products.update', ['id' => $selectedProduct]) }}" method="post">
                    {{-- <p>{{ route('products.update', ['id' => $selectedProduct]) }}</p> --}}
                <!-- <form id="editProductForm" action="" method="PUT"> -->
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editProductInventoryDateLabel">Inventory Date</label>
                        <input type="date" class="form-control" id="editProductInventoryDate" name="inventory_date" value="">
                    </div>
                    <div class="form-group">
                        <label for="editProductProductNameLabel">Product Name</label>
                        <input type="text" class="form-control" id="editProductProductName" name="product_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="editProductProductDescLabel">Product Description</label>
                        <textarea class="form-control" id="editProductProductDesc" name="product_desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editProductProductPriceLabel">Product Price</label>
                        <input type="number" step="0.01" class="form-control" id="editProductProductPrice" name="product_price" value="">
                    </div>
                    <div class="form-group">
                        <label for="editProductProductQuantityLabel">Product Quantity</label>
                        <input type="number" class="form-control" id="editProductProductQuantity" name="product_quantity" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="editProductSubmit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@push('header-scripts')
<script>
    $(document).ready(function() {
        console.log('ready on inventory');
    $('.edit-btn').click(function() {
        var productId = $(this).data('product-id');
        console.log('productId ',productId);

        var productName = $(this).parent().siblings('.tbl-product-name').html();
        var inventoryDate = $(this).parent().siblings('.tbl-inventory-date').html();
        var productDesc = $(this).parent().siblings('.tbl-product-desc').html();
        var productPrice = $(this).parent().siblings('.tbl-product-price').html();
        var productQuantity = $(this).parent().siblings('.tbl-product-quantity').html();
        console.log('productDetails ',{productName, inventoryDate, productDesc, productPrice, productQuantity});

        
        // $('#editProductForm').html(response);
        // $('#editProductForm').attr('action', `${window.location.href}/products/${productId}`);
        $('#editProductProductName').val(productName);
        $('#editProductInventoryDate').val(inventoryDate);
        $('#editProductProductDesc').val(productDesc);
        $('#editProductProductPrice').val(productPrice);
        $('#editProductProductQuantity').val(productQuantity);

        // $.ajax({
        //     url: '/products/' + productId + '/edit',
        //     type: 'GET',
        //     success: function(response) {
        //         // Populate the modal content with the fetched data
        //         $('#editProductForm').html(response);
        //         $('#editProductInventoryDate').val(response.InventoryDate);
        //         $('#editProductProductName').val(response.ProductName);
        //         $('#editProductProductDesc').val(response.ProductDesc);
        //         $('#editProductProductPrice').val(response.ProductPrice);
        //         $('#editProductProductQuantity').val(response.ProductQuantity);
                
        //     },
        //     error: function(xhr, status, error) {
        //         // Handle the error
        //         console.log(error);
        //     }
        // });
        // Show the modal
        // $('#editProductModal').modal('show');
    });
});
</script>
@endpush

@endsection