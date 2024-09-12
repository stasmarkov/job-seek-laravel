<?php

/**
 * @file
 * Contains routes for Employer related model.
 */

declare(strict_types=1);

use App\Http\Controllers\CandidateProfileController;
use App\Http\Controllers\EmployerProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(EmployerProfileController::class)->group(function () {
  Route::get('employer/{employerProfile}', 'show')
    ->name('profile.employer.show');

  Route::middleware(['auth', 'user_active'])->group(function () {
    Route::get('/account/{user}/employer/new', 'create')
      ->name('profile.employer.create');

    Route::post('/account/{user}/employer/new', 'store')
      ->name('profile.employer.store');

    Route::get('/account/{user}/employer', 'edit')
      ->name('profile.employer.edit');

    Route::patch('/account/{user}/employer', 'update')
      ->name('profile.employer.update');
  });
});

Route::controller(CandidateProfileController::class)->group(function () {
  Route::get('candidate/{candidateProfile}', 'show')
    ->name('candidate.show');

  Route::middleware(['auth', 'user_active'])->group(function () {
    Route::get('/account/{user}/candidate/new', 'create')
      ->name('profile.candidate.create');

    Route::post('/account/{user}/candidate/new', 'store')
      ->name('profile.candidate.store');

    Route::get('/account/{user}/candidate', 'edit')
      ->name('profile.candidate.edit');

    Route::patch('/account/{user}/candidate', 'update')
      ->name('profile.candidate.update');
  });
});
