<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    // Existing dashboard, students, and profile routes...

    // User Management Resource Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Root URL Redirect to Login
Route::redirect('/', '/login');

// Protected User Workspace Actions
Route::middleware(['auth'])->group(function () {
    
    // Core Layout Displays
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');

    // Student Database Modification API Endpoints
    Route::post('/students', [StudentController::class, 'store']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);

    // Profile Handling
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/user/profile-information', [ProfileController::class, 'update'])->name('profile.update');
});

// Guest Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');