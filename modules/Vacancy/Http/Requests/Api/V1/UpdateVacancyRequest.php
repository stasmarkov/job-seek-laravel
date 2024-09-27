<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Http\Requests\Api\V1;

/**
 * The vacancy update request.
 */
class UpdateVacancyRequest extends BaseVacancyRequest {

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'data' => ['sometimes', 'array'],
      'data.attributes' => ['sometimes', 'array'],
      'data.attributes.title' => ['sometimes', 'string'],
      'data.attributes.short_description' => ['max:250', 'sometimes', 'string'],
      'data.attributes.description' => ['sometimes', 'string'],
      'data.attributes.salary' => ['sometimes', 'string'],
      'data.attributes.location' => ['sometimes', 'string'],
      'data.attributes.schedule' => [
        'sometimes',
        'string',
        'in:Part-Time,Full-Time,Contract',
      ],
      'data.attributes.url' => ['sometimes', 'url', 'string'],
      'data.attributes.featured' => ['boolean'],
      'data.attributes.tags' => ['sometimes'],
      'data.relationships.author.data.id' => [
        'sometimes',
        'integer',
        'exists:Modules\Auth\Models\User,id',
      ],
    ];
  }

}
