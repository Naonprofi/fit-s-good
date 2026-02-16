<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FoodController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Ez a login nem védett (hiszen itt kapod a tokent)
Route::post('/login', [AuthController::class, 'login']);

// Csak tokenel érhető el a mentés és a törlés
Route::middleware('auth:sanctum')->group(function () {
    // Ezt mindenki látja (pl. étlap böngészése)
    Route::get('/foodsApi', [FoodController::class, 'index']);
    Route::get('/foodsApi/{food}', [FoodController::class, 'show']);

    // Csak az admin tud módosítani (ide láncoljuk be az admin ellenőrzést)
    Route::middleware('admin')->group(function () {
        Route::post('/foodsApi', [FoodController::class, 'store']);
        Route::put('/foodsApi/{food}', [FoodController::class, 'update']);
        Route::delete('/foodsApi/{food}', [FoodController::class, 'destroy']);
    });
});
