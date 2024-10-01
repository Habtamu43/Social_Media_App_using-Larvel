<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController; // Import CommentController
use App\Http\Controllers\UserController; // Import UserController
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Welcome Route
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard Route
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post Management Routes
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    
    // Comment Management Routes
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update'); // Update comment
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy'); // Delete comment
    
    // Like/Unlike Post Routes
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->middleware('auth');
    Route::delete('/posts/{post}/unlike', [PostController::class, 'unlike'])->middleware('auth');

    // User Profile Route
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show'); // View user profile
    
    // Feed Route
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index'); // View user's feed
   // Follow/Unfollow Routes
    Route::post('/users/{user}/follow', [UserController::class, 'follow'])->name('users.follow');
    Route::delete('/users/{user}/unfollow', [UserController::class, 'unfollow'])->name('users.unfollow');

});

// Authentication Routes
require __DIR__.'/auth.php';

