<?php

declare(strict_types = 1);

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Search\SearchJobsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/dashboard', static function () {
  return Inertia::render('Admin/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');
});

Route::get('/search', [SearchJobsController::class, 'index'])->name('search');

require __DIR__ . '/auth.php';
