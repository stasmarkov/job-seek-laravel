<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Http\Requests\VacancyCreateRequest;
use App\Models\EmployerProfile;
use Ramsey\Uuid\UuidInterface;

/**
 * The create Vacancy model job.
 */
final class CreateVacancy {

  /**
   * {@inheritdoc}
   */
  public function __construct(
    private UuidInterface $uuid,
    private string $title,
    private string $short_description,
    private string $description,
    private string $salary,
    private string $location,
    private string $schedule,
    private string $url,
    private bool $featured,
    private array $tags,
    private EmployerProfile $employerProfile,
  ) {
  }

  /**
   * Create the instance from the request.
   *
   * @param \App\Http\Requests\VacancyCreateRequest $request
   *   The create request.
   * @param \Ramsey\Uuid\UuidInterface $uuid
   *   The uuid of the model.
   *
   * @return self
   *   The instance.
   */
  public static function fromRequest(VacancyCreateRequest $request, UuidInterface $uuid): self {
    return new self(
      $uuid,
      $request->get('title'),
      $request->get('short_description'),
      $request->get('description'),
      $request->get('salary'),
      $request->get('location'),
      $request->get('schedule'),
      $request->get('url'),
      $request->get('featured') ?: FALSE,
      $request->get('tags'),
      $request->user()->employerProfile,
    );
  }

  /**
   * Handles the job operation.
   */
  public function handle(): void {
    $vacancy = $this->employerProfile->vacancies()->create([
      'uuid' => $this->uuid->toString(),
      'title' => $this->title,
      'short_description' => $this->short_description,
      'description' => $this->description,
      'salary' => $this->salary,
      'location' => $this->location,
      'schedule' => $this->schedule,
      'featured' => $this->featured,
      'url' => $this->url,
    ]);

    $vacancy->syncTags($this->tags);
  }

}
