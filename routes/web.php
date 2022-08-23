<?php

use App\Http\Controllers\HomeController;
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

Route::get('get-customer', [HomeController::class, "getCustomer"]);
Route::get('add-customer', [HomeController::class, "addCustomer"]);
Route::post('add-customer', [HomeController::class, "addCustomer"]);
Route::put('update-customer', [HomeController::class, "updateCustomer"]);
Route::delete('delete-customer', [HomeController::class, "deleteCustomer"]);
