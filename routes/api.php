<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/customers',CustomerController::class);
Route::apiResource('/orders',OrderController::class);

// Search by Siren or Siret Route
Route::get('/client/{sirenOrSiret}', [CustomerController::class, 'searchBySiren']);


// list of vendors Route
Route::get('/vendors', [VendorController::class, 'index']);

// list of offers Route
Route::get('/offers', [OfferController::class, 'index']);