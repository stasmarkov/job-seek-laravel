<?php

/**
 * @file
 * Admin routes.
 */

declare(strict_types=1);

use App\Enums\UserRolesEnum;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('role:' . UserRolesEnum::ADMIN->value)->group(function () {

  Route::get('admin/users', function () {
    $users = User::query()
      ->with(['employer', 'roles'])
      ->paginate(20);

    return Inertia::render('Model/User/List', [
      'users' => $users,
    ]);
  })->name('admin.users');
});

