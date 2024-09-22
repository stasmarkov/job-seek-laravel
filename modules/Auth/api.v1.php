<?php

/**
 * @file
 * The api.
 */

declare(strict_types = 1);

namespace Modules\Auth;

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\V1\AuthController;

Route::middleware('guest')
  ->post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')
  ->post('/logout', [AuthController::class, 'logout']);
