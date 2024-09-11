<?php

/**
 * @file
 * Contains routes for Employer related model.
 */

declare(strict_types=1);

use App\Http\Controllers\EmployerController;
use Illuminate\Support\Facades\Route;

Route::controller(EmployerController::class)->group(function () {
  Route::middleware('auth')->group(function () {
    Route::get('/employer/{employer_profile}/edit', 'edit')
      ->name('employer_profile.edit');
    Route::patch('/employer/{employer_profile}/edit', 'update')
      ->name('employer_profile.update');
  });
});
