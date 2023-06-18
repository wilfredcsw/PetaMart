<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use App\Models\Product;


class inventorycontroller extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.inventory', compact('products'));
    }

    /**
     * Store a newly created product in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'InventoryDate' => 'required|date',
            'ProductName' => 'required|string|max:50',
            'ProductDesc' => 'required|string|max:500',
            'ProductPrice' => 'required|numeric',
            'ProductQuantity' => 'required|integer',
        ]);

        $validatedData['TotalPrice'] = $validatedData['ProductPrice'] * $validatedData['ProductQuantity'];

        // Create a new product with the validated data
        Product::create($validatedData);

        // Redirect back to the inventory page with a success message
        return redirect()->route('pages.inventory')->with('success', 'Product added successfully!');
    }

    // Edit Controller Method
    public function edit($id)
    {
        DB::enableQueryLog();
        // $product = Product::findOrFail($id);
        $product = Product::find($id);
        dd(DB::getQueryLog());
        return $product;
    }

    // Update Controller Method
    public function update(Request $request, $id)
    {
        DB::enableQueryLog();

        // Validate the form data
        $validatedData = $request->validate([
            'InventoryDate' => 'required|date',
            'ProductName' => 'required|string|max:50',
            'ProductDesc' => 'required|string|max:500',
            'ProductPrice' => 'required|numeric',
            'ProductQuantity' => 'required|integer',
        ]);

        dd($validatedData);

        // $validatedData['TotalPrice'] = $validatedData['ProductPrice'] * $validatedData['ProductQuantity'];
        $totalPrice = $validatedData['ProductPrice'] * $validatedData['ProductQuantity'];

        // Find the product by ProductID
        // $product = Product::findOrFail($id);
        // $product = Product::where('ProductID', $id)->first();
        $product = Product::find($id);
        dd($product);
        $product->InventoryDate = $request->input('editProductInventoryDate');
        $product->ProductName = $request->input('editProductProductName');
        $product->ProductDesc = $request->input('editProductProductDesc');
        $product->ProductPrice = $request->input('editProductProductPrice');
        $product->ProductQuantity = $request->input('editProductProductQuantity');
        $product->TotalPrice = $totalPrice;
        $product->update();

        // Update the product with the validated data
        // $product->update($validatedData);

        dd(DB::getQueryLog());

        // Redirect back to the inventory page with a success message
        return redirect()->route('pages.inventory')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        // Redirect back to the inventory page with a success message
        return redirect()->route('pages.inventory')->with('success', 'Product deleted successfully!');
    }

}
