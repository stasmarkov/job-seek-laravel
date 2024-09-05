<?php

namespace App\Http\Resources;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Can;

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
      'tags' => TagResource::collection($this->tags),
      'location' => $this->location,
      'employer' => EmployerResource::make($this->employer),
      'can' => [
        'edit' => Auth::user()?->can('update', $this) ?? FALSE,
      ],
    ];
  }

}
