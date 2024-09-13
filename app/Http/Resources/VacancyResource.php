<?php

namespace App\Http\Resources;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * The vacancy resource.
 */
class VacancyResource extends JsonResource {

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
      'location' => $this->location,
      'tags' => TagResource::collection($this->tags),
      'employerProfile' => EmployerProfileResource::make($this->employerProfile),
      'created_at' => $this->created_at,
      'can' => [
        'edit' => Auth::user()?->can('update', $this) ?? FALSE,
      ],
    ];
  }

}
