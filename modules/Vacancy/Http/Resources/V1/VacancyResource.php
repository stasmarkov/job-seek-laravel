<?php

namespace Modules\Vacancy\Http\Resources\V1;

use App\Http\Resources\TagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Resources\V1\UserResource;
use Modules\Employer\Http\Resources\EmployerProfileResource;

/**
 * The vacancy resource.
 *
 * @mixin \Modules\Vacancy\Models\Vacancy
 */
class VacancyResource extends JsonResource {

  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array {
    return [
      'type' => 'vacancy',
      'id' => $this->getKey(),
      'attributes' => [
        'title' => $this->title,
        'featured' => $this->featured,
        'description' => $this->description,
        'shortDescription' => $this->short_description,
        'url' => $this->url,
        'schedule' => $this->schedule,
        'salary' => $this->salary,
        'location' => $this->location,
        'tags' => TagResource::collection($this->tags),
        'employerProfile' => EmployerProfileResource::make($this->employerProfile),
        'createdAt' => $this->created_at->format('j F, Y'),
        'can' => [
          'edit' => Auth::user()?->can('update', $this) ?? FALSE,
        ],
      ],
      'links' => [
        ['self' => $this->toUrl('api.v1.')],
      ],
      'relationships' => [
        'author' => [
          'data' => UserResource::make($this->employerProfile->user),
        ],
        'links' => [
          ['self' => 'tbd']
        ],
      ],
    ];
  }

}
