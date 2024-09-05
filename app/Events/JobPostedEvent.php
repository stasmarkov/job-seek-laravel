<?php

declare(strict_types = 1);

namespace App\Events;

use App\Models\Job;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * The Job Model entity created event.
 */
class JobPostedEvent {

  use Dispatchable, InteractsWithSockets, SerializesModels;

  /**
   * Create a new event instance.
   */
  public function __construct(public Job $job) {}

}
