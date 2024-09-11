<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

/**
 * The Login Log Model controller.
 */
class LoginLogController extends Controller {

  /**
   * The list of login logs models.
   */
  public function index() {
    return Inertia::render('Model/LoginLog/DashboardList', [
      'loginLogs' => Auth::user()->loginLogs()->paginate(50),
    ]);
  }

}
