<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ProfileController::class)->middleware('auth')->name('profile.')->group(function () {
    Route::get('/profile', 'edit')->name('edit');
    Route::patch('/profile', 'update')->name('update');
    Route::delete('/profile', 'destroy')->name('destroy');
});

require __DIR__.'/auth.php';
