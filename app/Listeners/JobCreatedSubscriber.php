<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\JobCreatedEvent;
use App\Models\User;
use App\Notifications\JobPostedNotification;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

/**
 * The send Job Model viewed notification.
 */
class JobCreatedSubscriber implements ShouldQueueAfterCommit {

  /**
   * Handle the event.
   */
  public function handleNotifications(JobCreatedEvent $event): void {
    // Send a notification to the all users for now.
    Notification::send(User::query()->has('candidateProfile')->get(), new JobPostedNotification($event->job));
  }

  /**
   * Delete caches.
   */
  public function handleCaches(JobCreatedEvent $event): void {
    Cache::delete('views:jobs:homepage:featured');
    Cache::delete('views:jobs:homepage:non-featured');
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   *   Events list.
   */
  public function subscribe(Dispatcher $events): void {
    $events->listen(
      JobCreatedEvent::class,
      [__CLASS__, 'handleNotifications']
    );
    $events->listen(
      JobCreatedEvent::class,
      [__CLASS__, 'handleCaches']
    );
  }

}
