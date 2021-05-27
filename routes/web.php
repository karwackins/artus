<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PrinterController;

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

//Route::get('/', function () {
//    return view('layouts/app');
//});
Route::get('/', [OrderController::class,'list']);
Route::resource('product',ProductsController::class);
Route::resource('order',OrderController::class);
Route::get('/orders', [OrderController::class, 'list']);
Route::get('/customer', [OrderController::class, 'customer']);
Route::post('/add-customer', [OrderController::class, 'addCustomer']);
Route::post('/save-order', [OrderController::class, 'saveOrder']);
Route::post('/add-to-cart', [ProductsController::class,'addToCart']);
Route::get('/edit-cart', [ProductsController::class, 'editCart']);
Route::get('/update-cart', [ProductsController::class, 'updateCart']);
Route::get('/pdf-kitchen/{id}', [PrinterController::class, 'kitchenPdf']);
Route::delete('/remove/{id}', [ProductsController::class, 'remove']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
