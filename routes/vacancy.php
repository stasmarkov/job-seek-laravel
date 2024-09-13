<?php

/**
 * @file
 * Contains routes for Vacancy related model.
 */

declare(strict_types=1);

use App\Http\Controllers\VacancyController;
use App\Http\Middleware\AddContext;
use Illuminate\Support\Facades\Route;

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
