<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;

// Installation Routes
Route::group(['prefix' => 'install', 'as' => 'install.'], function () {
    Route::get('/', [InstallController::class, 'index'])->name('index');
    Route::match(['GET', 'POST'], '/step/{step}', [InstallController::class, 'step'])->name('step');
});

// Check if application is installed
Route::middleware(['check.installed'])->group(function () {
    // Your main application routes will go here
    Route::get('/', function () {
        return view('welcome');
    });
});

// Fallback route for installation
Route::fallback(function () {
    if (!file_exists(storage_path('installed'))) {
        return redirect()->route('install.index');
    }
    
    return response('Not Found', 404);
});