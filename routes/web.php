<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewAuthController;
use App\Http\Controllers\Auth\NewPasswordResetController;
use App\Http\Controllers\SimplePasswordResetController;
use App\Http\Controllers\SimplePasswordChangeController;
use App\Http\Controllers\ManageProfileController;
use App\Http\Controllers\CanvasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserReferenceController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReferenceController;

// Welcome page route
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
// Admin routes
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/recent-canvases', [AdminController::class, 'allRecentCanvases'])->name('recent_canvases');
    // Reference management
    Route::resource('references', ReferenceController::class);
    Route::match(['GET', 'OPTIONS'], '/references/{reference}/download', [ReferenceController::class, 'download'])->name('references.download');
    // Example: Add users resource route if you have a UserController
    // Route::resource('users', UserController::class);
    });

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
// New independent auth routes (mounted under /new-auth so old system is untouched)
Route::prefix('new-auth')
    ->name('new.')
    ->group(function () {
        // Login Routes
        Route::get('login', [NewAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [NewAuthController::class, 'login'])->name('login.post');
    Route::post('logout', [NewAuthController::class, 'logout'])->name('logout');

    // Registration Routes
    Route::get('register', [NewAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [NewAuthController::class, 'register'])->name('register.post');

    // Password Reset Routes
        Route::get('forgot-password', [NewPasswordResetController::class, 'showLinkRequestForm'])
            ->name('password.request');
        Route::post('forgot-password', [NewPasswordResetController::class, 'sendResetLinkEmail'])
            ->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordResetController::class, 'showResetForm'])
            ->name('password.reset');
        Route::post('reset-password', [NewPasswordResetController::class, 'reset'])
            ->name('password.update');
    });

// Simple Password Reset Routes
Route::get('/forgot-password', [SimplePasswordResetController::class, 'showForgotForm'])
    ->name('password.request');
Route::post('/forgot-password', [SimplePasswordResetController::class, 'sendResetLink'])
    ->name('simple.password.email');
Route::get('/reset-password/{token}', [SimplePasswordResetController::class, 'showResetForm'])
    ->name('simple.password.reset');
Route::post('/reset-password', [SimplePasswordResetController::class, 'resetPassword'])
    ->name('simple.password.update');

// Simple Password Change Routes (single page)
Route::get('/change-password', [SimplePasswordChangeController::class, 'showChangeForm'])
    ->name('simple.password.change.form');
Route::post('/change-password', [SimplePasswordChangeController::class, 'changePassword'])
    ->name('simple.password.change');

// Dashboard routes
Route::middleware('auth')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// User profile routes (user-facing)
Route::get('/profile', [ManageProfileController::class, 'index'])->name('manageProfile')->middleware('auth');
Route::put('/profile', [ManageProfileController::class, 'update'])->name('manageProfile.update')->middleware('auth');
Route::post('/profile/remove-picture', [ManageProfileController::class, 'removeProfilePicture'])->name('manageProfile.removePicture')->middleware('auth');

// Canvas routes
Route::middleware('auth')->group(function () {
    Route::get('/mycanvas', [CanvasController::class, 'index'])->name('canvas.index');
    Route::get('/templates', [CanvasController::class, 'templates'])->name('templates');
    Route::get('/canvas/create', [CanvasController::class, 'create'])->name('canvas.create');
    Route::post('/canvas', [CanvasController::class, 'store'])->name('canvas.store');
    Route::get('/canvas/{canvas}', [CanvasController::class, 'show'])->name('canvas.show');
    Route::get('/canvas/{canvas}/edit', [CanvasController::class, 'edit'])->name('canvas.edit');
    Route::put('/canvas/{canvas}', [CanvasController::class, 'update'])->name('canvas.update');
    Route::delete('/canvas/{canvas}', [CanvasController::class, 'destroy'])->name('canvas.destroy');
    Route::get('/canvas/{canvas}/export', [CanvasController::class, 'export'])->name('canvas.export');

    // User reference routes (read-only)
    Route::get('/library', [UserReferenceController::class, 'index'])->name('references.index');
    Route::get('/library/{reference}', [UserReferenceController::class, 'show'])->name('references.show');
    Route::get('/library/{reference}/download', [UserReferenceController::class, 'download'])->name('references.download');
});

// Public PDF serving route for viewer (no auth middleware)
Route::get('/pdf/{reference}', [ReferenceController::class, 'servePdf'])->name('pdf.serve');