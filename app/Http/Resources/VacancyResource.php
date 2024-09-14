<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * The vacancy resource.
 *
 * @mixin \App\Models\Vacancy
 */
class VacancyResource extends JsonResource {

  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array {
    return [
      'id' => $this->getKey(),
      'title' => $this->title,
      'featured' => $this->featured,
      'description' => $this->description,
      'short_description' => $this->short_description,
      'url' => $this->url,
      'schedule' => $this->schedule,
      'salary' => $this->salary,
      'location' => $this->location,
      'tags' => TagResource::collection($this->tags),
      'employerProfile' => EmployerProfileResource::make($this->employerProfile),
      'created_at' => $this->created_at->format('j F, Y'),
      'can' => [
        'edit' => Auth::user()?->can('update', $this) ?? FALSE,
      ],
    ];
  }

}
