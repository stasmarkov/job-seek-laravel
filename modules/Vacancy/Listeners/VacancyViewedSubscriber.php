<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Listeners;

use App\Notifications\VacancyViewedNotification;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Notification;
use Modules\Vacancy\Events\VacancyViewedEvent;

/**
 * The send Vacancy Model viewed notification.
 */
class VacancyViewedSubscriber implements ShouldQueueAfterCommit {

  /**
   * Handle the event.
   */
  public function handle(VacancyViewedEvent $event): void {
    // Send a notification to the Vacancy owner.
    Notification::send($event->vacancy->employerProfile->user, new VacancyViewedNotification($event->vacancy));
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   *   Events list.
   */
  public function subscribe(Dispatcher $events): void {
    $events->listen(
      VacancyViewedEvent::class,
      [__CLASS__, 'handle']
    );
  }

}
