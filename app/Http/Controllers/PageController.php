<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Display announcement page
     *
     * @return \Illuminate\View\View
     */
    public function announcement()
    {
        return view('pages.announcement');
    }

    /**
     * Display product page
     *
     * @return \Illuminate\View\View
     */
    public function inventory()
    {
        return view('pages.inventory');
    }

    /**
     * Display schedule page
     *
     * @return \Illuminate\View\View
     */
    public function schedule()
    {
        return view('pages.schedule');
    }

    /**
     * Display product page
     *
     * @return \Illuminate\View\View
     */
    public function payment()
    {
        return view('pages.payment');
    }
}