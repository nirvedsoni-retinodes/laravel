<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\FacilityApiController;
use App\Http\Controllers\Api\VenueApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes
Route::get('/venues', [VenueApiController::class, 'index']);
Route::get('/venues/{venue}', [VenueApiController::class, 'show']);
Route::get('/facilities', [FacilityApiController::class, 'index']);
Route::get('/facilities/{facility}', [FacilityApiController::class, 'show']);
Route::get('/facilities/{facility}/availability', [FacilityApiController::class, 'availability']);

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('bookings', BookingApiController::class);
    Route::post('/bookings/{booking}/payment/initiate', [BookingApiController::class, 'initiatePayment']);
    Route::post('/bookings/{booking}/cancel', [BookingApiController::class, 'cancel']);
});

// Webhook routes
Route::post('/webhooks/razorpay', [BookingApiController::class, 'razorpayWebhook']);
