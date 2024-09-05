<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource {

  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'description' => $this->description,
      'short_description' => $this->short_description,
      'url' => $this->url,
      'schedule' => $this->schedule,
      'salary' => $this->salary,
      'tags' => $this->tags,
      'location' => $this->location,
      'employer' => $this->employer,
    ];
  }

}
