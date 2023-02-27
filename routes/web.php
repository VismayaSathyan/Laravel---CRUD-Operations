<?php

use App\Http\Controllers\ProductController;
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

    return view('welcome');
});


Route::get('/products/archive', [ProductController::class, 'archive'] )->name('products.archive');
Route::get('/products/fileDownload/{product}', [ProductController::class, 'fileDownload'] )->name('products.fileDownload');
Route::get('/products/{product}/restore', [ProductController::class, 'restore'] )->name('products.restore')->withTrashed();
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::delete('/products/{product}/delete', [ProductController::class, 'deleteForce'])->name('products.delete')->withTrashed();


Route::resource('products', ProductController::class);



// Route::get('products/{$product->id}', ['ProductController@restore'])->name('products.restore');
//Route::get('products/restore/{product}', [App\Http\Controllers\ProductController::class, 'restore'])->name('products.restore');
// Route::get('products/restore_all', [ProductController::class, 'restore_all'])->name('products.restore_all');
//Route::get('products/restore-all', [ProductController::class, 'restoreAll'])->name('products.restoreAll');