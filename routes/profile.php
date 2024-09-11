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
    Route::get('/user/{user}/profile', 'edit')
      ->name('profile.edit');
    Route::patch('/user/{user}/profile', 'update')
      ->name('profile.update');
  });
});
