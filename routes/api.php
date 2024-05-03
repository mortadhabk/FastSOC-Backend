<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/customers',CustomerController::class);
Route::apiResource('/orders',OrderController::class);

// Search by Siren or Siret Route
Route::get('/client/{sirenOrSiret}', [CustomerController::class, 'searchBySiren']);
