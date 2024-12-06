<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// welcome dashboard
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('register', [RegisterController::class, 'register'])->name('register');


// My dummy route
Route::get('test', function () {
    return response()->json(['message' => 'This is working!']);
});

// User Routes
Route::middleware(['auth:api'])->group(function () {
    // User Dashboard (protected route)
    // Route::get('user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Logout route (handles logout)
    Route::post('logout', function () {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully']);
    })->name('logout');
});

// Admin Routes
Route::middleware(['auth:api'])->group(function () {
    // Admin Dashboard
    // Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// User management (protected for admin)
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');
    Route::get('admin/exercises', [AdminController::class, 'addExercise'])->name('admin.addExercise');
    Route::post('admin/exercises', [AdminController::class, 'storeExercise']);
});

// Email Verification Routes
Route::middleware(['auth:api'])->group(function () {
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});

// Fitness Content (Protected route)
Route::middleware(['auth:api'])->get('fitness-content', function () {
    return response()->json(['content' => 'Fitness content here.']);
})->name('fitness.content');
