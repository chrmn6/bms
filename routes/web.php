<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes for managing users
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/staff', [UserController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [UserController::class, 'create'])->name('staff.create');
    Route::post('/staff/store', [UserController::class, 'store'])->name('staff.store');

    Route::get('/staff/{id}/edit', [UserController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{id}', [UserController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{id}', [UserController::class, 'destroy'])->name('staff.destroy');
});

// All Users Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('users.dashboard');
    })->name('dashboard');

    Route::get('/activities', function () {
        return view('users.activities');
    })->name('activities');

    Route::get('/announcement', function () {
        return view('users.announcement');
    })->name('announcement');

    Route::get('/emergency', function () {
        return view('users.emergency');
    })->name('emergency');

    Route::get('/clearance', function () {
        return view('users.clearance');
    })->name('clearance');

    Route::get('/blotter', function () {
        return view('users.blotter');
    })->name('blotter');
});

require __DIR__.'/auth.php';
