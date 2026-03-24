<?php

use App\Http\Controllers\CustContactController;
use App\Http\Controllers\CustDataController;
use App\Http\Controllers\CustMembershipController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\WorkerContactController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\WorkerDataController;
use App\Http\Controllers\WorkerJobTitleController;
use App\Http\Controllers\WorkerScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/cust-contact', CustContactController::class);
Route::resource('/cust-data', CustDataController::class);
Route::resource('/cust-membership', CustMembershipController::class);
Route::resource('/customer', CustomerController::class);
Route::resource('/reservation', ReservationController::class);
Route::resource('/worker-contact', WorkerContactController::class);
Route::resource('/worker', WorkerController::class);
Route::resource('/worker-data', WorkerDataController::class);
Route::resource('/worker-job', WorkerJobTitleController::class);
Route::resource('/worker-schedule', WorkerScheduleController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [CustomerController::class, 'show'])->name('profile');
Route::get('/profile/edit', [CustomerController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update/{customer}', [CustomerController::class, 'update'])->name('profile.update');
Route::get('/menu', [FoodController::class, 'index'])->name('menu');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/membership.upgrade', function () {
    return view('customers.membership_upgrade');})->name('membership.upgrade');
Route::get('/membership', function () {
    return view('customers.membership');})->name('membership');
Route::get('/contacts', function () {
    return view('contacts');})->name('contacts');
    Route::get('/reservations', function () {
    return view('customers.reservations');})->name('reservations');