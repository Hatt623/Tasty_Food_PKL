<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', \App\Http\Controllers\API\ApiProductsController::class)->except(['create', 'edit']);

Route::resource('contacts', \App\Http\Controllers\API\ApiContactController::class)->except(['create', 'edit']);

Route::resource('news', \App\Http\Controllers\API\ApiNewsController::class)->except(['create', 'edit']);

Route::resource('abouts', \App\Http\Controllers\API\ApiAboutController::class)->except(['create', 'edit']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

    Route::resource('reservations', \App\Http\Controllers\API\ApiReservationController::class);
    Route::post('reservations/{reservation}/cancel', [\App\Http\Controllers\API\ApiReservationController::class, 'cancel']);

    Route::get('/reservations/{reservation}/products', [\App\Http\Controllers\API\ApiReservationProductController::class, 'index']);
    Route::post('/reservations/{reservation}/products', [\App\Http\Controllers\API\ApiReservationProductController::class, 'store']);
    Route::patch('/reservations/{reservation}/products/{product}', [\App\Http\Controllers\API\ApiReservationProductController::class, 'update']);
    Route::delete('/reservations/{reservation}/products/{product}', [\App\Http\Controllers\API\ApiReservationProductController::class, 'destroy']);
});
