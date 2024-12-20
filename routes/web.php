<?php


use App\Http\Controllers\{
    AdminController,
    Auth\VerificationController,
    AuthController,
    ContactController,
    DevotionalController,
    RegisterController,
    TestimonialController,
    UserController,
    ForumController,
    PlanController,
    RoleController,
    SubscriptionCheckController,
    SubscriptionController,
    SubscriptionPlanController,
    VideoController,
    WorkoutController
};

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Dummy Route for Testing
Route::get('test', function () {
    return 'This is working!';
});

// Welcome Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');





// Route to show the role creation form
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
// Route to store the new role
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');





// Registration Routes
Route::get('register', function () {
    return view('auth.register'); // Registration form view
})->name('register.form');

Route::post('register', [RegisterController::class, 'register'])->name('register');



// Login and Logout Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard/user', function () {
    return view('dashboard.user');
})->name('dashboard.user');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to home or login page after logout
})->name('logout');




// Email Confirmation and Verification Routes
Route::get('/email-confirmation', function () {
    return view('auth.emailConfirmation');
})->middleware('auth')->name('email.confirmation');

Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');

Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');



// Protected Routes for Authenticated and Verified Users
Route::middleware(['auth', 'verified'])->group(function () {
    // User Dashboard
    Route::get('usersDashboard', [UserController::class, 'index'])->name('users.index');

    // Testimonials
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials/upload', [TestimonialController::class, 'store'])->name('testimonials.upload');
});


// Route for users to see videos
Route::get('/user/videos', [VideoController::class, 'usersVideos'])->name('user.videos.index');

// Contact
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Gallery
Route::get('/gallery', function () {
    return view('partials.gallery');
})->name('gallery');


Route::get('/workouts', [WorkoutController::class, 'index'])->middleware('check.subscription');


// Plans
Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');

Route::get('/plans/{id}', [PlanController::class, 'show'])->name('plans.show');


Route::get('/plans/dbf/create', [PlanController::class, 'create'])->name('plans.create');

Route::post('/plans/store', [PlanController::class, 'store'])->name('plans.store');




// Subscription plans

Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');

Route::post('/subscriptions/store', [SubscriptionController::class, 'store'])->name('subscriptions.store');

// Subscribing
Route::get('/subscriptions/{plan}/form', [SubscriptionController::class, 'showForm'])->name('subscriptions.form');

// Route::post('/subscriptions/submit', [SubscriptionController::class, 'submitForm'])->name('subscriptions.submit');













// Testimonials
Route::middleware(['auth', 'check.subscription:Normal|Premium'])->group(function () {
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.access');
});

Route::middleware(['auth', 'check.subscription:Premium'])->group(function () {
    Route::get('/forums', [ForumController::class, 'index'])->name('forums.access');
});


// Subscription plans route
Route::get('/subscriptions/plans', [SubscriptionController::class, 'index'])->name('subscriptions.plans');










// Admin-Specific Routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('adminTwo.dashboard');


    // Video Management
    Route::get('/admin/videos', [VideoController::class, 'index'])->name('admin.viewVideos');

    Route::get('/admin/videos/upload', [VideoController::class, 'create'])->name('admin.uploadVideo');
    Route::post('/admin/videos/upload', [VideoController::class, 'store'])->name('admin.storeVideo');









    // Devotional Management
    Route::get('/admin/devotionals', [DevotionalController::class, 'index'])->name('admin.viewDevotional');
    Route::get('/admin/upload-devotional', [DevotionalController::class, 'uploadDevotional'])->name('admin.uploadDevotional');
    Route::post('/admin/upload-devotional', [DevotionalController::class, 'storeDevotional'])->name('admin.storeDevotional');


    // Content Moderation (Pending Content)
    Route::get('/admin/pending-content', [AdminController::class, 'getPendingContent'])->name('admin.pendingContent');
    Route::post('/admin/approve-content/{id}', [AdminController::class, 'approveContent'])->name('admin.approveContent');
    Route::post('/admin/reject-content/{id}', [AdminController::class, 'rejectContent'])->name('admin.rejectContent');

    Route::post('/admin/logout', [AuthController::class, 'adminLogout'])
    ->name('admin.logout');


});


