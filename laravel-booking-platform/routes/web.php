<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstallController;

// Installation Routes
Route::group(['prefix' => 'install', 'as' => 'install.'], function () {
    Route::get('/', [InstallController::class, 'index'])->name('index');
    Route::match(['GET', 'POST'], '/step/{step}', [InstallController::class, 'step'])->name('step');
});

// Check if application is installed
Route::middleware(['check.installed'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        // Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Booking routes
        Route::resource('bookings', BookingController::class);
        Route::post('/bookings/{booking}/payment/initiate', [BookingController::class, 'initiatePayment'])->name('bookings.payment.initiate');
        Route::get('/bookings/{booking}/invoice', [BookingController::class, 'generateInvoice'])->name('bookings.invoice');
        
        // Admin routes
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
            Route::get('/admin/bookings/create', [AdminController::class, 'createBooking'])->name('admin.bookings.create');
            Route::post('/admin/bookings', [AdminController::class, 'storeBooking'])->name('admin.bookings.store');
            Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
            Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
        });

        // Manager routes
        Route::middleware(['role:manager'])->group(function () {
            Route::resource('venues', VenueController::class);
            Route::resource('facilities', FacilityController::class);
        });
    });

    // Payment callback route (no auth required)
    Route::post('/payment/callback', [BookingController::class, 'paymentCallback'])->name('payment.callback');
});

require __DIR__.'/auth.php';

// Fallback route for installation
Route::fallback(function () {
    if (!file_exists(storage_path('installed'))) {
        return redirect()->route('install.index');
    }
    
    return response('Not Found', 404);
});
