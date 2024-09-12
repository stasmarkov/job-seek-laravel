<?php

/**
 * @file
 * Contains routes.
 */

declare(strict_types=1);

use App\Enums\UserRolesEnum;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginLogController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RoleSelectController;
use App\Http\Controllers\Search\SearchJobsController;
use App\Http\Middleware\AddContext;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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


Route::get('/search', [SearchJobsController::class, 'index'])->name('search.jobs');


Route::get('playground', function () {

  $jobs = DB::table('jobs')
    ->selectRaw('count(id) as number_of_jobs, employer_profile_id')
    ->groupBy('employer_profile_id')
    ->having('number_of_jobs', '=', 1)
    ->skip(100)
    ->limit(5)
    ->get()
    ->dd();

  return 'Hello';
})->name('playground');


require __DIR__ . '/job.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
