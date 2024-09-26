<?php

declare(strict_types=1);

namespace Modules\Auth\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

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
      'type' => 'user',
      'id' => $this->id,
      'attributes' => [
        'name' => $this->name,
        'email' => $this->email,
        'status' => $this->status,
        'role' => $this->roles()?->first()?->name,
        $this->mergeWhen($request->routeIs('api.v1.user.*'), [
          'createdAt' => $this->created_at,
          'updatedAt' => $this->updated_at,
          'emailVerifiedAt' => $this->email_verified_at,
        ]),
      ],
      'links' => [
        'self' => $this->toUrl('api.v1.'),
      ],
    ];
  }

}
