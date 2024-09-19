<?php

/**
 * @file
 * Contains employer related routes.
 */

declare(strict_types = 1);

namespace Modules\Employer;

use Illuminate\Support\Facades\Route;
use Modules\Employer\Http\Controllers\EmployerProfileController;

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
