<?php

use App\Http\Controllers\Api\FoodController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/booksApi', [FoodController::class, "index"]);
Route::post("/booksApi", [FoodController::class, "store"]);
Route::put("/booksApi/{food}", [FoodController::class, "update"]);
Route::delete("/booksApi/{food}", [FoodController::class, "destroy"]);
Route::get("/booksApi/{food}", [FoodController::class, "show"]);