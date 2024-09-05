<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\JobViewedEvent;
use App\Notifications\JobViewedNotification;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Notification;

/**
 * The send Job Model viewed notification.
 */
class JobViewedSubscriber implements ShouldQueueAfterCommit {

  /**
   * Handle the event.
   */
  public function handle(JobViewedEvent $event): void {
    // Send a notification to the Job owner.
    Notification::send($event->job->employer->user, new JobViewedNotification($event->job));
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   *   Events list.
   */
  public function subscribe(Dispatcher $events): void {
    $events->listen(
      JobViewedEvent::class,
      [__CLASS__, 'handle']
    );
  }

}
