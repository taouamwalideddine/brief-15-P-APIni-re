<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('jwt.auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/plants', [PlantController::class, 'index']);
        Route::get('/plants/{slug}', [PlantController::class, 'show']);
    });

Route::middleware('jwt.auth')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);

    Route::get('/orders', [OrderController::class, 'index']);

    Route::get('/orders/{id}', [OrderController::class, 'show']);

    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
});
});
