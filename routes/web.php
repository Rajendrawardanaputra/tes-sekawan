<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\VehicleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('reservations', ReservationController::class);
    Route::post('reservations/{reservation}/approve', [ApprovalController::class, 'approve'])->name('reservations.approve');
    Route::post('reservations/{reservation}/reject', [ApprovalController::class, 'reject'])->name('reservations.reject');
    Route::resource('vehicles', VehicleController::class);
});

require __DIR__.'/auth.php';
