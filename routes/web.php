<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PurchaseController;

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
    return view('welcome');
});
//stock entry points
Route::get('/stock-info', [StockController::class, 'index']);
Route::get('/stock-info/{id}',[StockController::class, 'show']);
Route::post('/stock_create', [StockController::class, 'store']);
Route::post('/stock_update', [StockController::class, 'update']);
Route::delete('/stock_delete/{id}', [StockController::class, 'delete']);

//clients entry points
Route::get('/client-info', [ClientController::class, 'index']);
Route::get('/clients-purchase-info/{id}',[ClientController::class, 'show']);
Route::post('/addclient', [ClientController::class, 'store']);


//purchase entry points
Route::post('/purchase_stock', [StockController::class, 'store']);
Route::get('/purchase_stock', [PurchaseController::class, 'create']);
Route::post('/purchase_stock', [PurchaseController::class, 'store']);
