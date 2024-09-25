<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Modules\Auth\Models\User;
use Modules\Vacancy\Models\Vacancy;

/**
 * The dashboard controller.
 */
class DashboardController extends Controller {

  /**
   * The dashboard view page.
   */
  public function view() {
    $vacanciesCount = Vacancy::currentEmployer()->count();
    $loginsCount = Auth::user()->loginLogs->count();

    return Inertia::render('Admin/Dashboard', [
      'vacanciesCount' => $vacanciesCount,
      'loginsCount' => $loginsCount,
      'usersCount' => User::all()->count(),
    ]);
  }

}
