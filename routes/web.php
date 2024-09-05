<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Search\SearchJobsController;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', static function () {
  $jobs_featured = Job::latest()->with(['employer', 'tags'])->where('featured', TRUE)->limit(6)->get();
  $jobs = Job::latest()->with(['employer', 'tags'])->where('featured', FALSE)->limit(9)->get();

  return Inertia::render('Homepage', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
    'featuredJobs' => $jobs_featured,
    'jobs' => $jobs,
    'tags' => Tag::all(),
  ]);
})->name('homepage');

Route::get('/dashboard', static function () {
  return Inertia::render('Dashboard');
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
Route::post('/search', [SearchJobsController::class, 'doSearch'])->name('search.perform');
Route::get('/search/results', [SearchJobsController::class, 'results'])->name('search.results');

require __DIR__ . '/auth.php';
