<?php

declare(strict_types = 1);

namespace App\Http\Resources;

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
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'description' => $this->description,
    ];
  }

}
