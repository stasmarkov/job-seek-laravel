<?php

declare(strict_types=1);

namespace Modules\Candidate\Jobs;

use Modules\Auth\Models\User;
use Modules\Candidate\Http\Requests\CandidateProfileRequest;
use Modules\Candidate\Models\CandidateProfile;
use Ramsey\Uuid\UuidInterface;

/**
 * The create CandidateProfile model job.
 */
final class CreateCandidate {

  /**
   * {@inheritdoc}
   */
  public function __construct(
    private UuidInterface $uuid,
    private string $first_name,
    private string $last_name,
    private string $description,
    private int $experience_since,
    private array $tags,
    private User $owner,
  ) {
  }

  /**
   * Create the instance from the request.
   *
   * @param \Modules\Candidate\Http\Requests\CandidateProfileRequest $request
   *   The create request.
   * @param \Ramsey\Uuid\UuidInterface $uuid
   *   The uuid of the model.
   *
   * @return self
   *   The instance.
   */
  public static function fromRequest(CandidateProfileRequest $request, UuidInterface $uuid): self {
    return new self(
      $uuid,
      $request->get('first_name'),
      $request->get('last_name'),
      $request->get('description'),
      $request->get('experience_since'),
      $request->get('tags'),
      $request->getOwner(),
    );
  }

  /**
   * Handles the job operation.
   */
  public function handle(): void {
    $candidateProfile = CandidateProfile::query()->create([
      'uuid' => $this->uuid->toString(),
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'description' => $this->description,
      'experience_since' => $this->experience_since,
      'user_id' => $this->owner->id,
    ]);

    $candidateProfile->syncTags($this->tags);
  }

}
