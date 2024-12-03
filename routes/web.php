<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// My dummy route
Route::get('test', function () {
    return 'This is working!';
});



// DBF ROUTES
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



// Login routes (User)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');



// Route::get('/fitness-content', [AuthController::class, 'fitnessContent'])->middleware('auth');
Route::get('/fitness-content', function () {
    return view('fitness.content'); //
})->name('fitness.content')->middleware('auth'); // Protect route with 'auth' middleware


//Log out routes (User
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to home or login page after logout
})->name('logout');

