<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\JobPostedEvent;
use App\Events\JobViewedEvent;
use App\Models\User;
use App\Notifications\JobPostedNotification;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Notification;

/**
 * The send Job Model viewed notification.
 */
class JobPostedSubscriber implements ShouldQueueAfterCommit {

  /**
   * Handle the event.
   */
  public function handle(JobViewedEvent $event): void {
    // Send a notification to the all users for now.
    Notification::send(User::all(), new JobPostedNotification($event->job));
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   *   Events list.
   */
  public function subscribe(Dispatcher $events): void {
    $events->listen(
      JobPostedEvent::class,
      [__CLASS__, 'handle']
    );
  }

}
