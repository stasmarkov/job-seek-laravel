<?php

/**
 * @file
 * Contains vacancy related routes.
 */

declare(strict_types = 1);

namespace Modules\Vacancy;

use App\Http\Middleware\AddContext;
use Illuminate\Support\Facades\Route;
use Modules\Vacancy\Http\Controllers\VacancyController;

Route::controller(VacancyController::class)->group(function () {
  Route::middleware(['auth', 'user_active', AddContext::class])->group(function () {
    Route::get('/dashboard/vacancies', 'index')
      ->name('vacancy.index');

    Route::get('/dashboard/vacancy/add', 'create')
      ->name('vacancy.create');

    Route::post('/dashboard/vacancy/add', 'store')
      ->name('vacancy.store');

    Route::get('/dashboard/vacancy/{vacancy}/edit', 'edit')
      ->name('vacancy.edit');

    Route::patch('/dashboard/vacancy/{vacancy}/edit', 'update')
      ->name('vacancy.update');

    Route::get('/vacancy/{vacancy}/like', 'like')
      ->name('vacancy.like');
  });

  Route::get('/vacancy/{vacancy}', 'show')
    ->name('vacancy.show');
});
