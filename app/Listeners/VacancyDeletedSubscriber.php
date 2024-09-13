<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\VacancyDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Cache;

/**
 * The Vacancy Deleted event subscriber.
 */
class VacancyDeletedSubscriber implements ShouldQueueAfterCommit {

  /**
   * Delete caches.
   */
  public function handleCaches(VacancyDeletedEvent $event): void {
    Cache::delete('views:vacancies:homepage:featured');
    Cache::delete('views:vacancies:homepage:non-featured');
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   *   Events list.
   */
  public function subscribe(Dispatcher $events): void {
    $events->listen(
      VacancyDeletedEvent::class,
      [__CLASS__, 'handleCaches']
    );
  }

}
