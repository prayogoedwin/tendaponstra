<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DeviceController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SoundController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('device', DeviceController::class);
    Route::resource('sound', SoundController::class);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
