<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\LoginLog;
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
    $totalJobs = Job::all()->pluck('id')->count();
    $loginsCount = Auth::user()->loginLogs->count();

    return Inertia::render('Admin/Dashboard', [
      'totalJobs' => $totalJobs,
      'loginsCount' => $loginsCount,
      'usersCount' => User::all()->count(),
    ]);
  }

}
