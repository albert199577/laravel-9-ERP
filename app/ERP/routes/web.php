<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductsModelController;
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

Route::resource('product-model', ProductsModelController::class);

Route::resource('brand', BrandsController::class);

