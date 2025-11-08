<?php

use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend
Route::prefix('frontend')->name('frontend.')->group(function () {
    Route::get('/', FrontHomeController::class)->name('home')->middleware('auth');

    require __DIR__.'/auth.php';
});

// Backend
Route::prefix('backend')->name('backend.')->group(function () {
    Route::get('/', BackHomeController::class)->name('home')->middleware('admin');

    require __DIR__.'/admin_auth.php';
});

Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ProfileController::class)->middleware('auth')->name('profile.')->group(function () {
    Route::get('/profile', 'edit')->name('edit');
    Route::patch('/profile', 'update')->name('update');
    Route::delete('/profile', 'destroy')->name('destroy');
});
