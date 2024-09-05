<?php

namespace App\Listeners;

use App\Events\JobPostedEvent;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;

class SendNewJobNotification implements ShouldQueueAfterCommit {

  /**
   * Create the event listener.
   */
  public function __construct() {
    //
  }

  /**
   * Handle the event.
   */
  public function handle(JobPostedEvent $event): void {
    //
  }

}
