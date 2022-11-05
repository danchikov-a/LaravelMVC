<?php

use App\Http\Controllers\AdministrationProductController;
use App\Http\Controllers\AdministrationServiceController;
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

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/services/{service}', [ServiceController::class, 'show']);
Route::get('/services', [AdministrationServiceController::class, 'show']);
Route::get('/products/{product}/edit', [AdministrationProductController::class, 'edit']);
Route::get('/services/{service}/edit', [AdministrationServiceController::class, 'edit']);

Route::post('/products', [AdministrationProductController::class, 'store']);
Route::post('/services', [AdministrationServiceController::class, 'store']);

Route::delete('/products/{product}', [AdministrationProductController::class, 'destroy']);
Route::delete('/services/{service}', [AdministrationServiceController::class, 'destroy']);

Route::put('/products/{product}', [AdministrationProductController::class, 'update']);
Route::put('/services/{service}', [AdministrationServiceController::class, 'update']);
Route::put('/services/{service}/addToServiceToProduct', [CartController::class, 'addServiceToProduct']);
Route::put('/services/{service}/deleteServiceFromProduct', [CartController::class, 'deleteServiceFromProduct']);
