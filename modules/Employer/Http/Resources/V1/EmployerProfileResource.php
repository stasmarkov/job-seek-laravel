<?php

declare(strict_types = 1);

namespace Modules\Employer\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * The Employer Profile Resource.
 */
class EmployerProfileResource extends JsonResource {

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
      'type' => 'employer_profile',
      'id' => $this->id,
      'attributes' => [
        'name' => $this->name,
        'logo' => $this->logo,
      ],
    ];
  }

}
