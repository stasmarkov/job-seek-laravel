<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Http\Requests\VacancyUpdateRequest;
use App\Models\Vacancy;

/**
 * The create Vacancy model job.
 */
final class UpdateVacancy {

  /**
   * {@inheritdoc}
   */
  public function __construct(
    private Vacancy $vacancy,
    private string $title,
    private string $short_description,
    private string $description,
    private string $salary,
    private string $location,
    private string $schedule,
    private string $url,
    private bool $featured,
    private array $tags
  ) {
  }

  /**
   * Create the instance from the request.
   *
   * @param \App\Models\Vacancy $vacancy
   *   The vacancy model.
   * @param \App\Http\Requests\VacancyUpdateRequest $request
   *   The update request.
   *
   * @return self
   *   The instance.
   */
  public static function fromRequest(Vacancy $vacancy, VacancyUpdateRequest $request): self {
    return new self(
      $vacancy,
      $request->get('title'),
      $request->get('short_description'),
      $request->get('description'),
      $request->get('salary'),
      $request->get('location'),
      $request->get('schedule'),
      $request->get('url'),
      $request->get('featured') ?: FALSE,
      $request->get('tags'),
    );
  }

  /**
   * Handles the job operation.
   */
  public function handle(): void {
    $this->vacancy->update([
      'title' => $this->title,
      'short_description' => $this->short_description,
      'description' => $this->description,
      'salary' => $this->salary,
      'location' => $this->location,
      'schedule' => $this->schedule,
      'featured' => $this->featured,
      'url' => $this->url,
    ]);

    $this->vacancy->syncTags($this->tags);
  }

}
