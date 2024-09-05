<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Jobs\SendContactUsMailJob;
use Illuminate\Http\Request;
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
    $message = $request->get('contact_message');
    // Add the name to the queue and run it with prior.
    // php artisan queue:Work --queue=mail,default.
    SendContactUsMailJob::dispatch($message)->onQueue('mail');
    return back();
  }

}
