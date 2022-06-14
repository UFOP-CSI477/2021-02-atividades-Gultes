<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\StateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/products', ProductController::class);

    Route::resource('/states', StateController::class);

    Route::resource('/cities', CityController::class);

    Route::resource('/people', PeopleController::class);

    Route::resource('/purchases', PurchasesController::class);

    Route::get('/purchases.date', [PurchasesController::class, 'dateShow'])->name('purchases.date');

    Route::get('/purchases.products', [PurchasesController::class, 'productsShow'])->name('purchases.products');

    Route::get('/purchases.people', [PurchasesController::class, 'peopleShow'])->name('purchases.people');
});

require __DIR__ . '/auth.php';
