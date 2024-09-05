<?php

/**
 * @file
 * Contains routes for Job related model.
 */

declare(strict_types=1);

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::controller(JobController::class)->group(function () {
  Route::middleware('auth')->group(function () {
    Route::get('/job/add', 'create')
      ->name('job.create');

    Route::post('/job/add', 'store')
      ->name('job.store');

    Route::get('/job/{job}/edit', 'edit')
      ->name('job.edit');

    Route::patch('/job/{job}/edit', 'update')
      ->name('job.update');
  });

  Route::get('/job/{job}', 'index')
    ->name('job.index')
    ->can('view', 'job');
});
