<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'escape-rooms'], function () {
        Route::get('', [RoomController::class, 'all'])->name('escapeRooms');
        Route::get('{id}', [RoomController::class, 'get'])->name('getEscapeRoom');
        Route::get('{id}/time-slots', [RoomController::class, 'getTimeSlots'])->name('getEscapeRoomTimes');
    });

    Route::group(['prefix' => 'bookings'], function () {
        Route::post('', [BookingController::class, 'booking'])->name('booking');
        Route::get('', [BookingController::class, 'all'])->name('allBookings');
        Route::delete('{id}', [BookingController::class, 'cancel'])->name('getBookings');
        Route::get('{id}', [BookingController::class, 'get'])->name('getBookings');
    });
});

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
