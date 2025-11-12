<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminResidentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BlotterController;
use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD (Shared by Admin + Staff)
Route::middleware(['auth', 'verified', 'role:admin|staff'])
    ->get('/dashboard', [UserController::class, 'dashboard'])
    ->name('dashboard');

// ADMIN + STAFF ROUTES
Route::middleware(['auth', 'role:admin|staff'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Residents Management (shared)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('residents', [AdminResidentController::class, 'index'])->name('resident.index');
        Route::get('residents/{id}', [AdminResidentController::class, 'show'])->name('resident.show');
    });

    // Blotter Reports (shared)
    Route::get('/blotters/{id}/pdf', [BlotterController::class, 'blotterTranscript'])->name('blotter.pdf');
    Route::resource('blotters', BlotterController::class)->except(['destroy']);
});

// ADMIN-ONLY ROUTES

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Manage Staff Accounts
    Route::resource('staff', UserController::class);
    Route::resource('officials', OfficialController::class);
});

// STAFF + RESIDENT ROUTES

Route::middleware(['auth', 'role:resident|staff'])->group(function () {
    // Clearance PDF
    Route::get('/clearances/{clearance}/pdf', [ClearanceController::class, 'clearancePDF'])->name('clearances.pdf');
    Route::resource('clearances', ClearanceController::class);
});

// RESIDENT-ONLY ROUTES
Route::middleware(['auth', 'role:resident'])->prefix('residents')->name('residents.')->group(function () {
    Route::get('/dashboard', [ResidentController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ResidentController::class, 'edit'])->name('edit');
    Route::put('/profile', [ResidentController::class, 'update'])->name('update');
});

// ANNOUNCEMENTS & ACTIVITIES (All Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::resource('announcements', AnnouncementController::class);
    Route::get('/activities/events', [ActivityController::class, 'events'])->name('activities.events');
    Route::resource('activities', ActivityController::class);
    Route::resource('clearances', ClearanceController::class);
    Route::resource('blotters', BlotterController::class)->except(['destroy']);

    // Settings
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.updatePassword');
    Route::delete('/settings', [SettingsController::class, 'destroy'])->name('settings.destroy');
});

require __DIR__ . '/auth.php';