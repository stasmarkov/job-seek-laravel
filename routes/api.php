<?php

/**
 * @file
 * Contains routes for api.
 */

declare(strict_types = 1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Vacancy\Http\Resources\VacancyResource;
use Modules\Vacancy\Models\Vacancy;

Route::middleware('throttle:public_api')->group(function () {
  Route::get('/vacancies', function (Request $request) {
    return VacancyResource::collection((Vacancy::with('tags', 'employer')->paginate(10)));
  })->name('api.vacancies');

  Route::get('/user', function (Request $request) {
    return $request->user();
  })->middleware('auth:sanctum');
});
