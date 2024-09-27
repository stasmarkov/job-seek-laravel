<?php

/**
 * @file
 * The api.
 */

declare(strict_types = 1);

namespace Modules\Vacancy;

use Illuminate\Support\Facades\Route;
use Modules\Vacancy\Http\Controllers\Api\V1\UserVacancyController;
use Modules\Vacancy\Http\Controllers\Api\V1\VacancyController;

Route::middleware('auth:sanctum')->group(function () {
  Route::apiResource('vacancies', VacancyController::class)
    ->except(['update'])
    ->names([
      'index' => 'api.v1.vacancy.index',
      'show' => 'api.v1.vacancy.show',
      'store' => 'api.v1.vacancy.store',
      'replace' => 'api.v1.vacancy.replace',
      'destroy' => 'api.v1.vacancy.destroy',
    ]);

  Route::put('vacancies/{vacancy}', [VacancyController::class, 'replace'])
    ->name('api.v1.vacancy.replace');

  Route::patch('vacancies/{vacancy}', [VacancyController::class, 'update'])
    ->name('api.v1.vacancy.update');

  Route::apiResource('users.vacancies', UserVacancyController::class)
    ->names([
      'index' => 'api.v1.user.vacancy.index',
    ]);
});
