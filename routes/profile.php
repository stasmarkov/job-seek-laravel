<?php

/**
 * @file
 * Contains routes for Employer related model.
 */

declare(strict_types=1);

use App\Http\Controllers\EmployerProfileController;
use Illuminate\Support\Facades\Route;


Route::controller(EmployerProfileController::class)->group(function () {
  Route::get('employer/{employerProfile}', 'show')
    ->name('employer_profile.show');

  Route::middleware('auth')->group(function () {
    Route::get('/account/{user}/employer/create', 'edit')
      ->name('profile.employer.edit');
    Route::patch('/account/{user}/employer/profile', 'update')
      ->name('profile.employer.update');
  });
});
