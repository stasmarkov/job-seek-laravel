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
      ->with(['employerProfile', 'roles'])
      ->paginate(25);

    return Inertia::render('Model/User/DashboardList', [
      'users' => $users,
    ]);
  })->name('admin.users');
});
