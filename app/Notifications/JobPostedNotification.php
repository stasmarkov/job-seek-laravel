<?php

declare(strict_types = 1);

namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * The Job Model posted notification.
 */
class JobPostedNotification extends Notification {

  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(public Job $job) {}

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
      ->subject('The new has been recently posted. Take a look!')
      ->greeting('Hello!')
      ->line('The new job has been posted.')
      ->line($this->job->title)
      ->action('View job', url(route('job.index', ['job' => $this->job])))
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
