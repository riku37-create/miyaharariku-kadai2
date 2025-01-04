<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::prefix('products')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('products.index');
    Route::get('/register', [ProductController::class, 'register'])->name('products.register');
    Route::post('/register', [ProductController::class, 'create'])->name('products.create');
    Route::get('/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/{productId}', [ProductController::class, 'detail'])->name('products.detail');
    Route::post('/{productId}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{productId}/delete', [ProductController::class, 'delete'])->name('products.delete');
});
