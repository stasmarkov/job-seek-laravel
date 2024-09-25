<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Listeners;

use App\Notifications\VacancyPostedNotification;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Modules\Auth\Models\User;
use Modules\Vacancy\Events\VacancyCreatedEvent;

/**
 * The send Vacancy Model viewed notification.
 */
class VacancyCreatedSubscriber implements ShouldQueueAfterCommit {

  /**
   * Handle the event.
   */
  public function handleNotifications(VacancyCreatedEvent $event): void {
    // Send a notification to the all users for now.
    Notification::send(User::query()->has('candidateProfile')->get(), new VacancyPostedNotification($event->vacancy));
  }

  /**
   * Delete caches.
   */
  public function handleCaches(VacancyCreatedEvent $event): void {
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
      VacancyCreatedEvent::class,
      [__CLASS__, 'handleNotifications']
    );
    $events->listen(
      VacancyCreatedEvent::class,
      [__CLASS__, 'handleCaches']
    );
  }

}
