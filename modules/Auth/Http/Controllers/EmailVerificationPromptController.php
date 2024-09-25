<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends Controller {

  /**
   * Display the email verification prompt.
   */
  public function __invoke(Request $request): RedirectResponse|Response {
    return $request->user()->hasVerifiedEmail()
      ? redirect()->intended(route('dashboard', absolute: FALSE))
      : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
  }

}
