<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Models\LoginLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Request;

/**
 * Creates the Login Log.
 */
class LoginSubscriber {

  /**
   * Handle the event.
   */
  public function handle(Login $event) {
    LoginLog::create([
      'user_id' => $event->user->id,
      'ip' => Request::ip(),
    ]);
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   *   Events list.
   */
  public function subscribe(Dispatcher $events): array {
    return [
      Login::class => 'handle',
    ];
  }

}
