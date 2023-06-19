<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\inventorycontroller;

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
    
    Route::get('payment', ['as' => 'pages.payment', 'uses' => 'App\Http\Controllers\PageController@payment']);
    Route::get('sales', ['as' => 'pages.sales', 'uses' => 'App\Http\Controllers\PageController@sales']);
    Route::get('sales', ['as' => 'pages.sales', 'uses' => 'App\Http\Controllers\SalesController@index']);
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/payment', 'App\Http\Controllers\PaymentController@index');

    //Announcement parts
    Route::get('announcement', ['as' => 'pages.announcement', 'uses' => 'App\Http\Controllers\PageController@announcement']);
    Route::get('announcement', ['as' => 'pages.announcement', 'uses' => 'App\Http\Controllers\AnnouncementController@index']);
    Route::post('announcement', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('announcement/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
    Route::put('announcement/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
    
    //inventory parts dont touch
    Route::get('inventory', ['as' => 'pages.inventory', 'uses' => 'App\Http\Controllers\PageController@inventory']);
    Route::get('inventory', ['as' => 'pages.inventory', 'uses' => 'App\Http\Controllers\InventoryController@index']);
    // Add the following route for storing a product
    Route::post('products', [App\Http\Controllers\inventorycontroller::class, 'store'])->name('products.store');
    Route::post('products', ['as' => 'products.store', 'uses' => 'App\Http\Controllers\inventorycontroller@store']);
    Route::get('products/{id}/edit', [inventorycontroller::class, 'edit'])->name('products.edit');
    // Route::get('products/{product}', [App\Http\Controllers\inventorycontroller::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [inventorycontroller::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [App\Http\Controllers\inventorycontroller::class, 'destroy'])->name('products.destroy');

    //schedule parts
    Route::post('schedule', [App\Http\Controllers\ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('schedule', ['as' => 'pages.schedule', 'uses' => 'App\Http\Controllers\ScheduleController@index']);
    Route::delete('schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
    Route::put('schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
});   
