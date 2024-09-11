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
    ->name('employer_profile.show');

  Route::middleware('auth')->group(function () {
    Route::get('/account/{user}/employer', 'edit')
      ->name('profile.employer.edit');

    Route::patch('/account/{user}/employer', 'update')
      ->name('profile.employer.update');
  });
});

Route::controller(CandidateProfileController::class)->group(function () {
  Route::get('candidate/{candidateProfile}', 'show')
    ->name('employee.show');

  Route::middleware('auth')->group(function () {
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
