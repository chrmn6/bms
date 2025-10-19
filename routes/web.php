<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BlotterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

//FOR ADMIN AND STAFF
Route::middleware(['auth', 'role:admin|staff'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// All Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('staff', UserController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});

// All Staff Routes

Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
});

Route::prefix('staff')->as('staff.')->middleware(['auth','role:staff'])->group(function () {
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::resource('activities', ActivityController::class);
});


// All Residents Routes

Route::middleware(['auth', 'role:resident'])->prefix('residents')->name('residents.')->group(function () {
    Route::get('/dashboard', [ResidentController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:resident'])->group(function () {
    Route::get('/residents/profile', [ResidentController::class, 'edit'])->name('residents.edit');
    Route::put('/residents/profile', [ResidentController::class, 'update'])->name('residents.update');
});

Route::prefix('resident')->name('resident.')->group(function () {
    Route::get('/{id}/barangay-clearance', [CertificateController::class, 'barangayClearance'])->name('barangay-clearance');
    Route::get('/{id}/business-clearance', [CertificateController::class, 'businessClearance'])->name('business-clearance');
    Route::get('/{id}/residency-clearance', [CertificateController::class, 'residencyClearance'])->name('residency-clearance');
});

//ANNOUNCEMENT ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
});

// Staff only
Route::prefix('staff')->middleware(['auth','role:staff'])->name('staff.')->group(function () {
    Route::resource('announcements', AnnouncementController::class);
});

// ACTIVITIES ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
});

// Staff only
Route::prefix('staff')->middleware(['auth','role:staff'])->name('staff.')->group(function () {
    Route::resource('activities', ActivityController::class)->except(['index','show']);
});

// BLOTTER ROUTE
Route::resource('blotters', BlotterController::class)->except(['destroy']);

// BLOTTER ROUTE
Route::resource('clearance', ClearanceController::class)->except(['destroy']);

// Clearances
Route::resource('clearances', ClearanceController::class);

require __DIR__.'/auth.php';
