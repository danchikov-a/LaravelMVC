<?php

use App\Http\Controllers\Admin\AdministrationProductController;
use App\Http\Controllers\Admin\AdministrationServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
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

Route::get('/products', [ProductController::class, 'index'])->name('productsIndex');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('productsShow');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('servicesShow');
Route::get('/services', [AdministrationServiceController::class, 'show'])->name('servicesIndex');
Route::get('/products/{product}/edit', [AdministrationProductController::class, 'edit'])->name('productsEdit');
Route::get('/services/{service}/edit', [AdministrationServiceController::class, 'edit'])->name('servicesEdit');
Route::get('/cart', [CartController::class, 'index'])->name('cartIndex');

Route::post('/products', [AdministrationProductController::class, 'store'])->name('productsStore');
Route::post('/services', [AdministrationServiceController::class, 'store'])->name('servicesStore');
Route::post('/products/{product}/addToCart', [CartController::class, 'add'])->name('addToCart');

Route::delete('/products/{product}', [AdministrationProductController::class, 'destroy'])->name('productsDestroy');
Route::delete('/services/{service}', [AdministrationServiceController::class, 'destroy'])->name('servicesDestroy');
Route::delete('cart/{product}', [CartController::class, 'destroy'])->name('cartDestroy');

Route::put('/products/{product}', [AdministrationProductController::class, 'update'])->name('productsUpdate');
Route::put('/services/{service}', [AdministrationServiceController::class, 'update'])->name('servicesUpdate');
Route::put('/products/{product}/services/{service}/addServiceToProduct', [CartController::class, 'addServiceToProduct'])
    ->name('addServiceToProduct');
Route::put('/products/{product}/services/{service}/deleteServiceFromProduct', [CartController::class, 'deleteServiceFromProduct'])
    ->name('deleteServiceFromProduct');
