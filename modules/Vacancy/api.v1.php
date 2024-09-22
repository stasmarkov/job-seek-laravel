<?php

/**
 * @file
 * The api.
 */

declare(strict_types = 1);

namespace Modules\Vacancy;

use Illuminate\Support\Facades\Route;
use Modules\Vacancy\Http\Controllers\Api\V1\VacancyController;

Route::middleware('auth:sanctum')
  ->apiResource('vacancies', VacancyController::class)
  ->names([
    'index' => 'api.v1.vacancy.index',
    'show' => 'api.v1.vacancy.show',
    'store' => 'api.v1.vacancy.store',
    'update' => 'api.v1.vacancy.update',
    'destroy' => 'api.v1.vacancy.destroy',
  ]);
