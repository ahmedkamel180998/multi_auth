<?php

use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend
Route::prefix('frontend')->name('frontend.')->group(function () {
    Route::get('/', FrontHomeController::class)->name('home');
    Route::view('/login', 'frontend.auth.login')->name('auth.login');
    Route::view('/register', 'frontend.auth.register')->name('auth.register');
    Route::view('/forget-password', 'frontend.auth.forget-password')->name('auth.forget-password');
});

Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ProfileController::class)->middleware('auth')->name('profile.')->group(function () {
    Route::get('/profile', 'edit')->name('edit');
    Route::patch('/profile', 'update')->name('update');
    Route::delete('/profile', 'destroy')->name('destroy');
});

require __DIR__.'/auth.php';
