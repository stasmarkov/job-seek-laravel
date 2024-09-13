<?php

/**
 * @file
 * Contains routes for api.
 */

declare(strict_types = 1);

use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:public_api')->group(function () {
  Route::get('/vacancies', function (Request $request) {
    return VacancyResource::collection((Vacancy::with('tags', 'employer')->paginate(10)));
  })->name('api.vacancies');

  Route::get('/user', function (Request $request) {
    return $request->user();
  })->middleware('auth:sanctum');
});
