<?php

namespace Modules\Vacancy\Http\Resources\V1;

use App\Http\Resources\V1\TagResource;
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
   * {@inheritdoc}
   */
  public static $wrap = 'data';

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
        'shortDescription' => $this->short_description,
        'schedule' => $this->schedule,
        'salary' => $this->salary,
        'location' => $this->location,
        'employerProfile' => EmployerProfileResource::make($this->employerProfile),
        'createdAt' => $this->created_at->format('j F, Y, h:i'),
        'updatedAt' => $this->updated_at->format('j F, Y, h:i'),
        $this->mergeWhen($request->routeIs('api.v1.vacancy.show'), [
          'description' => $this->description,
          'url' => $this->url,
          'can' => [
            'edit' => Auth::user()?->can('update', $this) ?? FALSE,
          ]
        ]),
      ],
      'links' => [
        'self' => $this->toUrl('api.v1.'),
      ],
      'includes' => TagResource::collection($this->whenLoaded('tags')),
      'relationships' => [
        'author' => [
          'data' => UserResource::make($this->employerProfile->user),
        ],
        'links' => [
          'self' => $this->employerProfile->user->url
        ],
      ],
    ];
  }

}
