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
// Ez a login nem védett (hiszen itt kapod a tokent)
Route::post('/login', [AuthController::class, 'login']);
Route::get('/foodsApi', [FoodController::class, 'index']);
Route::get('/foodsApi/{food}', [FoodController::class, 'show']);
// Csak tokenel érhető el a mentés és a törlés
Route::middleware('auth:sanctum')->group(function () {
    // Csak az admin tud módosítani (ide láncoljuk be az admin ellenőrzést)
    Route::middleware('admin')->group(function () {
        Route::post('/foodsApi', [FoodController::class, 'store']);
        Route::put('/foodsApi/{food}', [FoodController::class, 'update']);
        Route::delete('/foodsApi/{food}', [FoodController::class, 'destroy']);
        Route::apiResource('/workersApi', WorkerController::class);
        Route::apiResource('/customersApi', CustomerController::class);
        Route::apiResource('/reservationsApi', ReservationController::class);
    });
});
