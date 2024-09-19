<?php

declare(strict_types = 1);

namespace Modules\Candidate\Http\Resources;

use App\Http\Resources\TagResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
      'id' => $this->id,
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'description' => $this->description,
      'tags' => TagResource::collection($this->tags),
      'experience_since' => $this->experience_since,
      'user' => UserResource::make($this->user),
      'created_at' => $this->created_at->format('j F, Y'),
    ];
  }

}
