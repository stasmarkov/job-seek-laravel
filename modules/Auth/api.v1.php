<?php

/**
 * @file
 * The api.
 */

declare(strict_types = 1);

namespace Modules\Auth;

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\V1\AuthController;
use Modules\Auth\Http\Controllers\Api\V1\UserController;

Route::middleware('guest')
  ->post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')
  ->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')
  ->apiResource('users', UserController::class)
  ->names([
    'index' => 'api.v1.user.index',
    'show' => 'api.v1.user.show',
    'store' => 'api.v1.user.store',
    'update' => 'api.v1.user.update',
    'destroy' => 'api.v1.user.destroy',
  ]);
