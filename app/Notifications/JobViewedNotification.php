<?php

declare(strict_types = 1);

namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

/**
 * The Job Model viewed notification.
 */
class JobViewedNotification extends Notification implements ShouldQueue {

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
    return ['broadcast'];
  }

  /**
   * Get the broadcastable representation of the notification.
   */
  public function toBroadcast(object $notifiable): BroadcastMessage {
    $link = route('job.show', ['job' => $this->job->id]);

    return new BroadcastMessage([
      'message' => "The job has been posted: <a class='text-gray-200 hover:text-blue-400' href='{$link}'>{$this->job->title}</a>",
    ]);
  }

}
