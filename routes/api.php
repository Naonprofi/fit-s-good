<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/foodsApi', [FoodController::class, 'index']);
Route::get('/foodsApi/{food}', [FoodController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('admin')->group(function () {
        Route::post('/foodsApi', [FoodController::class, 'store']);
        Route::put('/foodsApi/{id}', [FoodController::class, 'update']);
        Route::delete('/foodsApi/{id}', [FoodController::class, 'destroy']);
        Route::apiResource('/workersApi', WorkerController::class);
        Route::apiResource('/customersApi', CustomerController::class);
        Route::apiResource('/reservationsApi', ReservationController::class);
    });
});
