<?php

declare(strict_types = 1);

namespace App\Events;

use App\Models\Vacancy;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * The Vacancy Model entity deleted event.
 */
class VacancyDeletedEvent {

  use Dispatchable, InteractsWithSockets, SerializesModels;

  /**
   * Create a new event instance.
   */
  public function __construct(public Vacancy $vacancy) {}

}
