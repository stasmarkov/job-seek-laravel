<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Vacancy\Models\Vacancy;

/**
 * The Vacancy Model entity created event.
 */
class VacancyCreatedEvent {

  use Dispatchable, InteractsWithSockets, SerializesModels;

  /**
   * Create a new event instance.
   */
  public function __construct(public Vacancy $vacancy) {}

}
