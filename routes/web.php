<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);


// My dummy route
Route::get('test', function () {
    return 'This is working!';
});



// DBF ROUTES
// USER
// welcome dashboard
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Registering a user
// registration form
Route::get('register', function () {
    return view('auth.register'); // Registration form view
})->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');
// Get all users
Route::get('users', [RegisterController::class, 'index']);

// View for verifying
Route::get('verify', function () {
    return view('auth.verify');
})->name('verify');

// // User Dashboard
// Route::middleware(['auth', 'role:user'])->get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');



// Login routes (User)

// Login Form Display
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

// Login Form Submission
Route::post('/login', [AuthController::class, 'login'])->name('login');










// User dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});



//Log out routes (User
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to home or login page after logout
})->name('logout');


// ADMIN
// Admin dashboard after logging in
Route::middleware(['auth'])->group(function () {
    Route::get('/admin_dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});



// Route to handle email verification
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');

// Route to handle the email verification link click
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('/admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');
//     Route::get('/admin/exercises', [AdminController::class, 'addExercise'])->name('admin.addExercise');
//     Route::post('/admin/exercises', [AdminController::class, 'storeExercise']);
// });



// Route::get('/fitness-content', [AuthController::class, 'fitnessContent'])->middleware('auth');
Route::get('/fitness-content', function () {
    return view('fitness.content'); //
})->name('fitness.content')->middleware('auth'); // Protect route with 'auth' middleware
