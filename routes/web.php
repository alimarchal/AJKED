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
    Route::get('/dashboard', function () {

//        DB::enableQueryLog();
//        $query = \App\Models\StockInOut::where('product_id', 2)->whereBetween('created_at', [\Carbon\Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d 00:00:00'),\Carbon\Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d 23:59:59'),])->latest()->first();
//        $query = \App\Models\StockInOut::where('product_id',2)->where('type','Credit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get();
//        dd($query);
//        dd(DB::getQueryLog());


        return view('dashboard');
    })->name('dashboard');
    Route::resource('/supplier', \App\Http\Controllers\SupplierController::class);
    Route::resource('/division', \App\Http\Controllers\DivisionController::class);
    Route::resource('/purchaseOrder', \App\Http\Controllers\PurchaseOrderController::class);
    Route::resource('/scheme', \App\Http\Controllers\SchemeController::class);
    Route::resource('/storeItem', \App\Http\Controllers\StoreItemController::class);
    Route::resource('/category', \App\Http\Controllers\CategoryController::class);
    Route::resource('/product', \App\Http\Controllers\ProductController::class);
    Route::get('/stockOut', [\App\Http\Controllers\StockInOutController::class, 'stockOut'])->name('product.stockOut');
    Route::post('/stockOutStore', [\App\Http\Controllers\StockInOutController::class, 'stockOutStore'])->name('product.stockOutStore');

    Route::get('/stockInDeliveryChalan', [\App\Http\Controllers\StockInOutController::class, 'stockInDeliveryChalan'])->name('product.stockInDeliveryChalan');
    Route::get('/stockInReceivingIndent', [\App\Http\Controllers\StockInOutController::class, 'stockInReceivingIndent'])->name('product.stockInReceivingIndent');
    Route::get('/stockInReceivingScheme', [\App\Http\Controllers\StockInOutController::class, 'stockInReceivingScheme'])->name('product.stockInReceivingScheme');
    Route::post('/stockInStore', [\App\Http\Controllers\StockInOutController::class, 'stockInStore'])->name('product.stockInStore');


    Route::get('/stockOut', [\App\Http\Controllers\StockInOutController::class, 'stockOutIndent'])->name('product.stockOut');
    Route::get('/stockOutStore', [\App\Http\Controllers\StockInOutController::class, 'stockOutStore'])->name('product.stockOutStore');
    Route::get('/stockOutScheme', [\App\Http\Controllers\StockInOutController::class, 'stockOutIndentScheme'])->name('product.stockOutScheme');
    Route::Post('/stockOutSchemeStore', [\App\Http\Controllers\StockInOutController::class, 'stockOutSchemeStore'])->name('product.stockOutSchemeStore');


    // transaction history
    Route::get('/transactionHistory', [\App\Http\Controllers\TransactionHistory::class, 'index'])->name('transactionHistory.index');

    Route::get('/stockInRegister', [\App\Http\Controllers\StockInOutController::class, 'stockInRegister'])->name('product.stockInRegister');
    Route::get('/stockOutRegister', [\App\Http\Controllers\StockInOutController::class, 'stockOutRegister'])->name('product.stockOutRegister');
    Route::get('/report/stock-return', [\App\Http\Controllers\ReportController::class, 'stockReturn'])->name('report.stockReturn');

    Route::resource('/stockInOut', \App\Http\Controllers\StockInOutController::class);
});
