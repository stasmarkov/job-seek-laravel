<?php

/**
 * @file
 * Contains candidate profile related routes.
 */

declare(strict_types = 1);

namespace Modules\Candidate;

use Illuminate\Support\Facades\Route;
use Modules\Candidate\Http\Controllers\CandidateProfileController;

Route::controller(CandidateProfileController::class)->group(function () {
  Route::get('candidate/{candidate_profile}', 'show')
    ->name('profile.candidate.show');

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
