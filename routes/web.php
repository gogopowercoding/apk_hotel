<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\CustomerRoomController;
use App\Http\Controllers\CustomerBookingController;

Route::get('/', fn() => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::prefix('customer')->group(function () {
        Route::get('/rooms', [CustomerRoomController::class, 'index'])->name('customer.rooms.index');
        Route::get('/bookings', [CustomerBookingController::class, 'index'])->name('customer.bookings.index');
        Route::get('/rooms/{room}/book', [CustomerBookingController::class, 'create'])->name('customer.bookings.create');
        Route::post('/rooms/{room}/book', [CustomerBookingController::class, 'store'])->name('customer.bookings.store');
        Route::post('/bookings/{booking}/pay', [CustomerBookingController::class, 'pay'])->name('customer.bookings.pay');
        Route::post('/bookings/{booking}/checkout', [CustomerBookingController::class, 'checkout'])->name('customer.bookings.checkout');
        Route::delete('/bookings/{booking}', [CustomerBookingController::class, 'destroy'])->name('customer.bookings.destroy');
    });
    Route::prefix('admin')->group(function () {
        Route::resource('rooms', AdminRoomController::class)->names('admin.rooms');
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        Route::post('/bookings/{booking}/confirm', [AdminBookingController::class, 'confirm'])->name('admin.bookings.confirm');
        Route::post('/bookings/{booking}/cancel', [AdminBookingController::class, 'cancel'])->name('admin.bookings.cancel');
    });
});
