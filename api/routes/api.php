<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressSearchController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::resource('/contacts',ContactController::class);

Route::get('/contacts/export/csv', [ContactController::class, 'exportCsv'])->name('contacts.export-csv');

Route::get('/address-search/{postal_code}', [AddressSearchController::class, 'searchAddressByPostalCode']);
