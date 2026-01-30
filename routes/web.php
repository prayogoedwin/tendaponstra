<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DeviceController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SoundController;
use App\Http\Controllers\Dashboard\TrackingDeviceController;
use App\Http\Controllers\Dashboard\UserController;
use App\Models\User;
use App\Notifications\SosNotification;
use Illuminate\Support\Facades\Route;
use NotificationChannels\Fcm\FcmChannel;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('device', DeviceController::class);
    Route::resource('sound', SoundController::class);
    Route::resource('tracking', TrackingDeviceController::class);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('notif', function () {
    try {
        $user = User::where('email', 'atasnama740@gmail.com')->first();
        $user->notify(new SosNotification(FcmChannel::class, 'SOS Tolong Bossssss', [
            'lat' => '7.026265',
            'lng' => '110.418854'
        ]));
        return response()->json(['success' => true]);
    } catch (\Throwable $th) {
        return response()->json(['success' => false, 'message' => $th->getMessage()]);
    }
});
