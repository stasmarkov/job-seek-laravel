<?php

/**
 * @file
 * Contains routes for Job related model.
 */

declare(strict_types=1);

use App\Http\Controllers\JobController;
use App\Http\Middleware\AddContext;
use Illuminate\Support\Facades\Route;

Route::controller(JobController::class)->group(function () {
  Route::middleware(['auth', AddContext::class])->group(function () {
    Route::get('/dashboard/jobs', 'index')
      ->name('job.index');

    Route::get('/dashboard/job/add', 'create')
      ->name('job.create');

    Route::post('/dashboard/job/add', 'store')
      ->name('job.store');

    Route::get('/dashboard/job/{job}/edit', 'edit')
      ->name('job.edit');

    Route::patch('/dashboard/job/{job}/edit', 'update')
      ->name('job.update');

    Route::get('/job/{job}/like', 'like')
      ->name('job.like');
  });

  Route::get('/job/{job}', 'show')
    ->name('job.show');
});
