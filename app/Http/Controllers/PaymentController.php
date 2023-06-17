<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('pages.payment', ['payments'=>$payments]);
    }

}
