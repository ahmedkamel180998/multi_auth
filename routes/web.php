<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\Back\RoleController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend
Route::prefix('frontend')->name('frontend.')->group(function () {
    Route::get('/', FrontHomeController::class)->name('home')->middleware('auth');

    require __DIR__.'/auth.php';
});

// Backend
Route::prefix('backend')->name('backend.')->group(function () {
    Route::get('/', BackHomeController::class)->name('home')->middleware('admin');

    // Admins
    Route::resource('admins', AdminController::class)->only(['index', 'store', 'update', 'destroy']);
    // Users
    Route::resource('users', UserController::class)->only(['index', 'store', 'update', 'destroy']);
    // Roles
    Route::resource('roles', RoleController::class)->only(['index', 'store', 'update', 'destroy']);

    require __DIR__.'/admin_auth.php';
});

Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ProfileController::class)->middleware('auth')->name('profile.')->group(function () {
    Route::get('/profile', 'edit')->name('edit');
    Route::patch('/profile', 'update')->name('update');
    Route::delete('/profile', 'destroy')->name('destroy');
});
