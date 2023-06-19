<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;

class PaymentController extends Controller
{
    public function index()
    {
        // $payments = Payment::all();
        // return view('pages.payment', ['payments'=>$payments]);
        $products = Product::all();
        return view('pages.payment', compact('products'));
    }

}
