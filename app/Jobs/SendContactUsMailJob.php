<?php

declare(strict_types = 1);

namespace App\Jobs;

use App\Mail\ContactUsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * The contact us vacancy.
 */
class SendContactUsMailJob implements ShouldQueue {

  use Queueable, InteractsWithQueue, Dispatchable;

  /**
   * Create a new vacancy instance.
   */
  public function __construct(public array $data) {}

  /**
   * Execute the vacancy.
   */
  public function handle(): void {
    try {
      Context::push('queued_jobs', json_encode($this, JSON_THROW_ON_ERROR));
      Mail::send(new ContactUsMail($this->data));
    }
    catch (\JsonException $e) {
      Log::error($e);
    }
  }

}
