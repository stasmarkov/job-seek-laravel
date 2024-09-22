<?php

namespace Modules\Auth\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

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
        'createdAt' => $this->created_at,
        'updatedAt' => $this->updated_at,
      ],
    ];
  }

}
