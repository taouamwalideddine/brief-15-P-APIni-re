<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\PlantController; // Correct namespace for PlantController
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/plants', [PlantController::class, 'index']);
    Route::get('/plants/{slug}', [PlantController::class, 'show']);

    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
});

Route::middleware(['jwt.auth', 'employee'])->group(function () {
    Route::get('/employee/orders', [OrderController::class, 'employeeIndex']);
    Route::put('/employee/orders/{id}', [OrderController::class, 'employeeUpdate']);
    Route::get('/employee/orders/{id}', [OrderController::class, 'employeeShow']);
});

Route::middleware(['jwt.auth', 'admin'])->group(function () {
    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::post('/admin/categories', [CategoryController::class, 'store']);
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']);

    Route::get('/admin/plants', [PlantController::class, 'index']);
    Route::post('/admin/plants', [PlantController::class, 'store']);
    Route::put('/admin/plants/{id}', [PlantController::class, 'update']);
    Route::delete('/admin/plants/{id}', [PlantController::class, 'destroy']);
});

Route::middleware(['jwt.auth', 'admin'])->group(function () {
    Route::get('/admin/statistics', [StatisticsController::class, 'index']);
});
