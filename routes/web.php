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
    PageController,
    PlanController,
    RoleController,
    SubscriptionCheckController,
    SubscriptionController,
    SubscriptionPlanController,
    VideoController,
    WorkoutController,
    PostController,
    CommentController,
    MpesaController,
    ProgressController
};
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Models\Devotional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PaystackController;


// Auth::routes(['verify' => true]);



// Dummy Route for Testing
Route::get('test', function () {
    return 'This is working!';
});

// Welcome Page
Route::get('/', function () {
    return view('welcome');
})->name('home');





// Route to show the role creation form
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
// Route to store the new role
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');





// Registration Routes
Route::get('register', function () {
    return view('auth.register'); // Registration form view
})->name('register.form');

Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::get('users', [RegisterController::class, 'viewAllUsers'])->name('users');






Route::get('/email/confirmation', function () {
    return view('auth.emailConfirmation');
})->name('email.confirmation');



// Route for the user's dashboard - protected by email verification
Route::middleware('verified')->get('/dashboard', function () {
    return view('dashboard.user');
})->name('dashboard');



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
Route::get('/email/confirmation', function () {
    return view('auth.emailConfirmation');
})->name('email.confirmation');

Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');

Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['throttle:6,1'])
    ->name('verification.verify');










Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset password routes
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');


Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// User Dashboard
Route::get('user/dashboard', [UserController::class, 'index'])->name('users.index');

// Testimonials



Route::middleware(['auth'])->group(function () {

    Route::get('/user/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');

    Route::post('/user/testimonials/upload', [TestimonialController::class, 'store'])->name('testimonials.store');


    Route::get('user/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

    Route::get('/testimonials/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');
});


Route::resource('posts', PostController::class);

Route::post('comments', [CommentController::class, 'store'])->name('comments.store');


Route::post('/posts/{post}/like', [PostController::class, 'like'])->middleware('auth')->name('posts.like');

Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->middleware('auth')->name('posts.comment');



// Route for users to see videos
Route::get('/user/videos', [VideoController::class, 'usersVideos'])->name('user.videos.index');

Route::get('/user/devotionals', [DevotionalController::class, 'usersDevotionals'])->name('user.devotionals.index');

// routes/web.php
Route::post('/mark-video-done', [VideoController::class, 'markVideoDone'])->name('mark.video.done');







// Contact
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// About Us
Route::get('/about', [PageController::class, 'aboutUs'])->name('aboutUs.index');



Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');

Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');













// Gallery
Route::get('/gallery', function () {
    return view('partials.gallery');
})->name('gallery');



Route::get('/workouts', [WorkoutController::class, 'index'])->middleware('check.subscription');


// Plans
Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');

Route::get('/subscriptions/choose', [SubscriptionController::class, 'index'])->name('subscriptions.choose');


Route::get('/plans/{id}', [PlanController::class, 'show'])->name('plans.show');







// Subscription plans

Route::get('/all/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');

Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');





// Subscribing
Route::get('/subscriptions/form/{plan}', [SubscriptionController::class, 'showForm'])->name('subscriptions.form');



Route::post('/subscribe', [SubscriptionController::class, 'initiatePayment'])->name('subscriptions.pay');


Route::post('/paystack/pay', [PaystackController::class, 'pay'])->name('paystack.pay');

Route::get('/paystack/callback', [PaystackController::class, 'handlePaystackCallback'])->name('paystack.callback');

Route::post('/paystack/webhook', [PaystackController::class, 'webhook'])->name('paystack.webhook');









// Videos according to the subscription type
Route::get('/videos/personal-training', [VideoController::class, 'personalTraining'])->name('videos.personalTraining');

Route::get('/videos/build-his-temple', [VideoController::class, 'buildHisTemple'])->name('videos.buildHisTemple');

Route::get('/videos/free-trial', [VideoController::class, 'showFreeTrialVideos'])
    ->middleware('track.free.trial')
    ->name('videos.freeTrial');

Route::get('/dashboard', [VideoController::class, 'indexing'])->name('dashboard');



Route::get('/videos/challenges', [VideoController::class, 'showChallengesVideos'])->name('videos.challenges');


Route::post('/videos/{video}/mark-as-done', [SubscriptionController::class, 'markVideoAsDone'])->name('videos.markAsDone');


Route::get('/upgrade-level', [SubscriptionController::class, 'upgradeLevel'])->name('upgrade.level');


Route::get('/videos', [VideoController::class, 'usersVideos'])->name('videos.index');



Route::get('/progress/chart', [ProgressController::class, 'index'])->name('progress.chart');



Route::post('/progress', [ProgressController::class, 'store'])->name('progress.store');

Route::put('/progress/update/{id}', [ProgressController::class, 'update'])->name('progress.update');

Route::get('/track-progress', [ProgressController::class, 'showProgressForm'])->name('track.progress');



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

    // Edit video form
    Route::get('admin/videos/{id}/edit', [VideoController::class, 'edit'])->name('admin.editVideo');

    // Update video details
    Route::put('admin/videos/{id}', [VideoController::class, 'update'])->name('admin.updateVideo');

    // Delete video
    Route::delete('admin/videos/{id}', [VideoController::class, 'destroy'])->name('admin.deleteVideo');

    // Level JUmping
    Route::get('/admin/level-jump-requests', [AdminController::class, 'viewLevelJumpRequests'])->name('admin.levelJumpRequests');
    Route::post('/admin/level-jump-approve/{id}', [AdminController::class, 'approveLevelJump'])->name('admin.approveLevelJump');
    Route::post('/admin/level-jump-reject/{id}', [AdminController::class, 'rejectLevelJump'])->name('admin.rejectLevelJump');



    // Devotional Management
    Route::get('/admin/devotionals', [DevotionalController::class, 'index'])->name('admin.viewDevotionals');
    Route::get('/admin/devotionals/upload', [DevotionalController::class, 'create'])->name('admin.uploadDevotional');
    Route::post('/admin/devotionals/store', [DevotionalController::class, 'store'])->name('admin.storeDevotional');

    // Edit and Update Devotional
    Route::get('/admin/devotionals/{id}/edit', [DevotionalController::class, 'edit'])->name('admin.editDevotional');
    Route::put('/admin/devotionals/{id}', [DevotionalController::class, 'update'])->name('admin.updateDevotional');
    Route::delete('/admin/devotionals/{id}', [DevotionalController::class, 'destroy'])->name('admin.deleteDevotional');


    // Plans
    Route::get('/plans/dbf/create', [PlanController::class, 'create'])->name('plans.create');
    Route::post('/plans/store', [PlanController::class, 'store'])->name('plans.store');
    Route::get('/admin/plans', [PlanController::class, 'plans'])->name('admin.plans');

    Route::get('/admin/plans/{id}/edit', [PlanController::class, 'editPlan'])->name('admin.editPlan');
    Route::put('/admin/plans/{id}', [PlanController::class, 'updatePlan'])->name('admin.updatePlan');
    Route::delete('/admin/plans/{id}', [PlanController::class, 'destroyPlan'])->name('admin.deletePlan');








    Route::post('/admin/logout', [AuthController::class, 'adminLogout'])
        ->name('admin.logout');
});




