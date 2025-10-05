<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//FOR ADMIN AND STAFF
Route::middleware(['auth', 'role:admin|staff'])->group(function () {
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

//ANNOUNCEMENT ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
});

// Staff only
Route::prefix('staff')->middleware(['auth','role:staff'])->name('staff.')->group(function () {
    Route::resource('announcements', AnnouncementController::class);
});

// ACTIVITIES ROUTE
Route::middleware(['auth'])->group(function () {
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
});

// Staff only
Route::prefix('staff')->middleware(['auth','role:staff'])->name('staff.')->group(function () {
    Route::resource('activities', ActivityController::class)->except(['index','show']);
});


require __DIR__.'/auth.php';
