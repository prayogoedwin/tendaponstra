<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PublicController;
use App\Services\SoundSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::post('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/get-payload', [PublicController::class, 'getDevice']);
    Route::post('get-device', [PublicController::class, 'getDevice']);
    Route::get('get-sound', [PublicController::class, 'getSound']);
    Route::post('refresh-token-fcm', [AuthController::class, 'refreshTokenFcm']);
});
