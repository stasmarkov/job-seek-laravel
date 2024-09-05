<?php

/**
 * @file
 * Contains routes.
 */

declare(strict_types=1);

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Search\SearchJobsController;
use App\Http\Middleware\AddContext;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/dashboard', static function () {
  return Inertia::render('Admin/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', AddContext::class])->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');

  Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');

  Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');
});


Route::get('/search', [SearchJobsController::class, 'index'])->name('search.jobs');

require __DIR__ . '/job.php';
require __DIR__ . '/employer.php';
require __DIR__ . '/auth.php';
