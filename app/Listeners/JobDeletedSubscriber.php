<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\JobDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Cache;

/**
 * The Job Deleted event subscriber.
 */
class JobDeletedSubscriber implements ShouldQueueAfterCommit {

  /**
   * Delete caches.
   */
  public function handleCaches(JobDeletedEvent $event): void {
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
      JobDeletedEvent::class,
      [__CLASS__, 'handleCaches']
    );
  }

}
