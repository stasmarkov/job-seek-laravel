<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

/**
 * The dashboard controller.
 */
class DashboardController extends Controller {

  /**
   * The dashboard view page.
   */
  public function view() {
    $jobsCount = Job::currentEmployer()->count();
    $loginsCount = Auth::user()->loginLogs->count();

    return Inertia::render('Admin/Dashboard', [
      'jobsCount' => $jobsCount,
      'loginsCount' => $loginsCount,
      'usersCount' => User::all()->count(),
    ]);
  }

}
