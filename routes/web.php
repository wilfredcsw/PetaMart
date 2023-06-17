<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('inventory', ['as' => 'pages.inventory', 'uses' => 'App\Http\Controllers\PageController@inventory']);
    Route::get('announcement', ['as' => 'pages.announcement', 'uses' => 'App\Http\Controllers\PageController@announcement']);
    Route::get('schedule', ['as' => 'pages.schedule', 'uses' => 'App\Http\Controllers\PageController@schedule']);
    Route::get('payment', ['as' => 'pages.payment', 'uses' => 'App\Http\Controllers\PageController@payment']);
    Route::get('sales', ['as' => 'pages.sales', 'uses' => 'App\Http\Controllers\PageController@sales']);
    
    Route::get('inventory', ['as' => 'pages.inventory', 'uses' => 'App\Http\Controllers\InventoryController@index']);
    Route::get('sales', ['as' => 'pages.sales', 'uses' => 'App\Http\Controllers\SalesController@index']);
    // Route::get('payment', ['as' => 'pages.payment', 'uses' => 'App\Http\Controllers\PaymentController@index']);


    // Add the following route for storing a product
    Route::post('products', [App\Http\Controllers\InventoryController::class, 'store'])->name('products.store');

    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/payment', 'App\Http\Controllers\PaymentController@index');


});