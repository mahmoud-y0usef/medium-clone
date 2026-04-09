<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public home (redirects to dashboard if authenticated)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search (auth required)
Route::get('/search', [SearchController::class, 'index'])->middleware(['auth', 'verified'])->name('search');

// Create post (must be before the slug route to avoid "create" being matched as a slug)
Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('posts.create');

// Post reading (auth required — guests are redirected to home/modal)
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->middleware(['auth', 'verified'])->name('posts.show');

// User profile (auth required)
Route::get('/users/{user}', [UserController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');

// Dashboard (auth + verified)
Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Auth-only routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Onboarding
    Route::get('/onboarding', [OnboardingController::class, 'index'])->name('onboarding.index');
    Route::post('/onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');

    // Profile settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post write/edit/delete
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Likes
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');

    // Bookmarks / Library
    Route::post('/posts/{post}/bookmark', [BookmarkController::class, 'toggle'])->name('posts.bookmark');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');

    // Follow
    Route::post('/users/{user}/follow', [FollowController::class, 'toggle'])->name('users.follow');

    // Stories (user's own)
    Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');

    // Stats
    Route::get('/stats', [StatsController::class, 'index'])->name('stats.index');

    // Following feed
    Route::get('/following', [FollowingController::class, 'index'])->name('following.index');
});

require __DIR__.'/auth.php';

