<?php

/**
 * @file
 * Contains routes for api.
 */

declare(strict_types = 1);

use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:public_api')->group(function () {
  Route::get('/jobs', function (Request $request) {
    return JobResource::collection((Job::with('tags', 'employer')->paginate(10)));
  })->name('api.jobs');

  Route::get('/user', function (Request $request) {
    return $request->user();
  })->middleware('auth:sanctum');
});
