<?php

/**
 * @file
 * Contains routes.
 */

declare(strict_types=1);

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginLogController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RoleSelectController;
use App\Http\Controllers\Search\SearchCandidatesController;
use App\Http\Controllers\Search\SearchVacanciesController;
use App\Http\Middleware\AddContext;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'view'])
    ->name('dashboard');

  Route::get('/log/logins', [LoginLogController::class, 'index'])
    ->name('login_logs.index');
});

Route::get('/contact', [ContactController::class, 'index'])
  ->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])
  ->name('contact.store');

Route::middleware(['auth', AddContext::class])->group(function () {
  Route::get('/account/{user}/edit', [AccountController::class, 'edit'])
    ->name('account.edit');

  Route::patch('/account/{user}/edit', [AccountController::class, 'update'])
    ->name('account.update');

  Route::delete('/account/{user}/delete', [AccountController::class, 'destroy'])
    ->name('account.destroy');

  Route::get('/profile/role-select', [RoleSelectController::class, 'edit'])
    ->withoutMiddleware('user_has_role')
    ->name('profile.role_select');
  Route::post('/profile/role-select', [RoleSelectController::class, 'update'])
    ->withoutMiddleware('user_has_role')
    ->name('profile.role_select.update');
});

Route::get('/search/vacancies', [SearchVacanciesController::class, 'index'])->name('search.vacancies');
Route::get('/search/candidates', [SearchCandidatesController::class, 'index'])->name('search.candidates');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
