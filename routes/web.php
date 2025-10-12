<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BlotterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ResidentController;
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

// Admin routes for managing users
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('staff', UserController::class)->except(['show']);
});

// All Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

// All Staff Routes
Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('dashboard');
});

Route::prefix('staff')->as('staff.')->middleware(['auth','role:staff'])->group(function () {
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::resource('activities', ActivityController::class);
});


// All Residents Routes
Route::prefix('residents')->name('residents.')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth', 'role:resident'])->prefix('residents')->name('residents.')->group(function () {
    Route::get('/dashboard', function () {
        return view('residents.dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:resident'])->group(function () {
    Route::get('/residents/profile', [ResidentController::class, 'edit'])->name('residents.edit');
    Route::put('/residents/profile', [ResidentController::class, 'update'])->name('residents.update');
});

// All Users Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/contact', function () {
        return view('contact.index');
    })->name('contact');

    Route::get('/clearance', function () {
        return view('clearance.index');
    })->name('clearance');
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

require __DIR__.'/auth.php';
