<?php

/**
 * @file
 * Provides routes.
 */

declare(strict_types =1);

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index'])->name('homepage');

Route::middleware('auth')->group(function () {
  Route::get('/jobs/create', [JobController::class, 'create'])->name('job.create');
  Route::post('/jobs/create', [JobController::class, 'store'])->name('job.store');
});

Route::get('/search', SearchController::class)->name('search');

Route::get('/tags/{tag:name}', TagController::class)->name('tag.index');

Route::middleware('guest')->group(function () {
  Route::controller(RegisteredUserController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store')->name('register.action');
  });

  Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.action');
  });
});

Route::middleware('auth')->group(function () {
  Route::controller(SessionController::class)->group(function () {
    Route::delete('/logout', 'destroy')->name('logout');
  });
});

Route::controller(BlogPostController::class)->group(function () {
  Route::get('/blog', 'index')->name('blog_post.index');
  Route::get('/blog/{blog_post}', 'show')->name('blog_post.show');
  Route::get('/blog/{blog_post}/like', 'like')->name('blog_post.like');
});
