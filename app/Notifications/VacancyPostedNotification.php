<?php

declare(strict_types = 1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Vacancy\Models\Vacancy;

/**
 * The Vacancy Model posted notification.
 */
class VacancyPostedNotification extends Notification {

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
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage {
    return (new MailMessage)
      ->subject('The new vancacy has been recently posted. Take a look!')
      ->greeting('Hello!')
      ->line('The new vacancy has been posted.')
      ->line($this->vacancy->title)
      ->action('View vacancy', url(route('vacancy.show', ['vacancy' => $this->vacancy])))
      ->line('Thank you for using our application!');
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array {
    return [];
  }

}
