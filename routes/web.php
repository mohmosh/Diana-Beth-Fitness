<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;


// Auth::routes(['verify' => true]);


// My dummy route
Route::get('test', function () {
    return 'This is working!';
});



// DBF ROUTES
// welcome dashboard
Route::get('/', function () {
    return view('welcome');
})->name('welcome');



// Register
Route::get('register', function () {
    return view('auth.register'); // Registration form view
})->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');
// Get all registered users
Route::get('users', [RegisterController::class, 'viewAllUsers']);



// Login routes (User)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//Log out routes (User
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to home or login page after logout
})->name('logout');



// View for verifying
Route::get('verify', function () {
    return view('auth.verify');
})->name('verify');


// Route to handle email verification
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');

// Route to handle the email verification link click
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');



// User dashboard
Route::get('usersDashboard', [UserController::class, 'index'])->name('users.index');

     // Testimonials (User)
     Route::middleware(['auth'])->group(function () {
        //Getting all my testimonies
     Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');


     Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');

     Route::get('/testimonials/upload', [TestimonialController::class, 'store'])->name('testimonials.index');
     Route::post('/testimonials/upload', [TestimonialController::class, 'create'])->name('testimonials.upload');



});

// Forum API's
Route::prefix('forum')->name('forum.')->group(function () {
    Route::get('/', [ForumController::class, 'index'])->name('index');
    Route::get('/{category}', [ForumController::class, 'showCategory'])->name('category');
    Route::get('/{category}/{thread}', [ForumController::class, 'showThread'])->name('thread');
    Route::post('/{category}/{thread}/post', [ForumController::class, 'storePost'])->name('post.store');
});


// ADMIN DASHBOARD and routes
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Route::get('/admin/upload-photo', [AdminController::class, 'showUploadPhoto'])->name('admin.showUploadPhoto');
    // Route::post('/admin/upload-photo', [AdminController::class, 'uploadPhoto'])->name('admin.uploadPhoto');

    Route::get('/admin/upload-video', [AdminController::class, 'showUploadVideo'])->name('admin.showUploadVideo');
    Route::post('/admin/upload-video', [AdminController::class, 'uploadVideo'])->name('admin.uploadVideo');

    Route::get('/admin/dash', [AdminController::class, 'dash'])->name('admin.dash');











    Route::get('/admin/pending-content', [AdminController::class, 'getPendingContent'])->name('admin.pendingContent');
    Route::post('/admin/approve-content/{id}', [AdminController::class, 'approveContent'])->name('admin.approveContent');
    Route::post('/admin/reject-content/{id}', [AdminController::class, 'rejectContent'])->name('admin.rejectContent');
});




























