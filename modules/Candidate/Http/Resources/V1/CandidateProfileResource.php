<?php

declare(strict_types = 1);

namespace Modules\Candidate\Http\Resources\V1;

use App\Http\Resources\TagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Http\Resources\V1\UserResource;

/**
 * The Employer Profile Resource.
 */
class CandidateProfileResource extends JsonResource {

  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array {
    return [
      'type' => 'candidate_profile',
      'id' => $this->id,
      'attributes' => [
        'firstName' => $this->first_name,
        'lastName' => $this->last_name,
        'description' => $this->description,
        'tags' => TagResource::collection($this->tags),
        'experienceSince' => $this->experience_since,
        'user' => UserResource::make($this->user),
        'createdAt' => $this->created_at->format('j F, Y'),
      ],
    ];
  }

}
