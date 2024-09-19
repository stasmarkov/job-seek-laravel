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
  Route::get('candidate/{user}', 'show')
    ->name('candidate_profile.show');

  Route::middleware(['auth', 'user_active'])->group(function () {
    Route::get('/account/{user}/candidate/new', 'create')
      ->name('candidate_profile.create');

    Route::post('/account/{user}/candidate/new', 'store')
      ->name('candidate_profile.store');

    Route::get('/account/{user}/candidate', 'edit')
      ->name('candidate_profile.edit');

    Route::patch('/account/{user}/candidate', 'update')
      ->name('candidate_profile.update');
  });
});
