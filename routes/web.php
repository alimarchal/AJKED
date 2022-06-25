<?php

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
    return to_route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::resource('/supplier', \App\Http\Controllers\SupplierController::class);
    Route::resource('/division', \App\Http\Controllers\DivisionController::class);
    Route::resource('/purchaseOrder', \App\Http\Controllers\PurchaseOrderController::class);
    Route::resource('/scheme', \App\Http\Controllers\SchemeController::class);
    Route::resource('/storeItem', \App\Http\Controllers\StoreItemController::class);
    Route::resource('/category', \App\Http\Controllers\CategoryController::class);
    Route::resource('/product', \App\Http\Controllers\ProductController::class);
    Route::get('/stockOut', [\App\Http\Controllers\StockInOutController::class,'stockOut'])->name('product.stockOut');
    Route::post('/stockOutStore', [\App\Http\Controllers\StockInOutController::class,'stockOutStore'])->name('product.stockOutStore');

    Route::get('/stockIn', [\App\Http\Controllers\StockInOutController::class,'stockIn'])->name('product.stockIn');
    Route::post('/stockInStore', [\App\Http\Controllers\StockInOutController::class,'stockInStore'])->name('product.stockInStore');

    Route::get('/stockInRegister', [\App\Http\Controllers\StockInOutController::class,'stockInRegister'])->name('product.stockInRegister');
    Route::get('/stockOutRegister', [\App\Http\Controllers\StockInOutController::class,'stockOutRegister'])->name('product.stockOutRegister');
    Route::get('/report/stock-return', [\App\Http\Controllers\ReportController::class,'stockReturn'])->name('report.stockReturn');

    Route::resource('/stockInOut', \App\Http\Controllers\StockInOutController::class);
});
