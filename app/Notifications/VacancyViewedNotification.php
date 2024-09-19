<?php

declare(strict_types = 1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Modules\Vacancy\Models\Vacancy;

/**
 * The Vacancy Model viewed notification.
 */
class VacancyViewedNotification extends Notification implements ShouldQueue {

  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(public Vacancy $vacancy) {}

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array {
    return ['broadcast'];
  }

  /**
   * Get the broadcastable representation of the notification.
   */
  public function toBroadcast(object $notifiable): BroadcastMessage {
    $link = route('vacancy.show', ['vacancy' => $this->vacancy->id]);

    return new BroadcastMessage([
      'message' => "The vacancy has been posted: <a class='text-gray-200 hover:text-blue-400' href='{$link}'>{$this->vacancy->title}</a>",
    ]);
  }

}
