<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BlotterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Admin\AdminResidentController;
use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//FOR ADMIN AND STAFF
Route::middleware(['auth', 'role:admin|staff'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Residents List accessed by admin and staff
Route::middleware(['auth', 'role:admin|staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('residents', [AdminResidentController::class, 'index'])->name('resident.index');
    Route::get('/residents/{id}', [AdminResidentController::class, 'show'])->name('resident.show');
});

// All Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    // Staff
    Route::resource('staff', UserController::class)->only(['index','create','store','show','destroy']);
});

// All Staff Routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
});


// All Residents Routes
Route::middleware(['auth', 'role:resident'])->prefix('residents')->name('residents.')->group(function () {
    Route::get('/dashboard', [ResidentController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:resident'])->group(function () {
    Route::get('/residents/profile', [ResidentController::class, 'edit'])->name('residents.edit');
    Route::put('/residents/profile', [ResidentController::class, 'update'])->name('residents.update');
});

// ANNOUNCEMENTS
// Authenticated users (view only)
Route::middleware(['auth'])->group(function () {
    Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');

    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
});

// STAFF ONLY
Route::prefix('staff')->middleware(['auth','role:staff'])->name('staff.')->group(function () {
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('activities', ActivityController::class);
});


// BLOTTER ROUTE
Route::middleware(['auth', 'role:admin|staff'])->group(function () {
    Route::get('/blotters/{id}/pdf', [BlotterController::class, 'blotterTranscript'])->name('blotter.pdf');
});
Route::resource('blotters', BlotterController::class)->except(['destroy']);

//CLEARANCE ROUTE
Route::middleware(['auth', 'role:resident|staff'])->group(function () {
    Route::get('/clearances/{clearance}/pdf', [ClearanceController::class, 'clearancePDF'])->name('clearances.pdf');
});
Route::resource('clearances', ClearanceController::class);

//Settings
Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.updatePassword');
    Route::delete('/settings', [SettingsController::class, 'destroy'])->name('settings.destroy');
});

require __DIR__.'/auth.php';
