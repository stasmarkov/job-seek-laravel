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
    Route::get('/employer/{employer}/edit', 'edit')
      ->name('employer.edit');
    Route::patch('/employer/{employer}/edit', 'update')
      ->name('employer.update');
  });
});
