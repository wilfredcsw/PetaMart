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

    public function addtocart()
    {
        $products = Product::all();
        return view('pages.payment', compact('products'));
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
            'inventory_id' => 'required',
            'product_id' => 'required',
            'inventory_date' => 'required|date',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        // Create a new product with the validated data
        Product::create($validatedData);

        // Redirect back to the inventory page with a success message
        return redirect()->route('pages.inventory')->with('success', 'Product added successfully.');
    }
    
}
