<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Jobs\SendContactUsMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

/**
 * The contact us controller.
 */
class ContactController extends Controller {

  /**
   * The contact us page.
   *
   * @return \Inertia\Response
   *   The response.
   */
  public function index() {
    return Inertia::render('Contact');
  }

  /**
   * The store controller.
   *
   * @param \Illuminate\Http\Request $request
   *   The income request.
   *
   * @return \Illuminate\Http\RedirectResponse
   *   The response.
   */
  public function store(Request $request) {
    $data = $request->validate([
      'first_name' => ['required'],
      'last_name' => ['required'],
      'email' => ['required', 'email'],
      'contact_message' => ['required'],
    ]);

    // Add the name to the queue and run it with prior.
    // php artisan queue:Work --queue=mail,default.
    SendContactUsMailJob::dispatch($data)->onQueue('mail');
    return back();
  }

}
