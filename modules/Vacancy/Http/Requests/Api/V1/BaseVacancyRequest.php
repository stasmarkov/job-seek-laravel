<?php

declare(strict_types=1);

namespace Modules\Vacancy\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Employer\Models\EmployerProfile;
use Modules\Employer\Policies\EmployerProfilePolicy;

/**
 * {@inheritdoc}
 */
class BaseVacancyRequest extends FormRequest {

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool {
    return TRUE;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'data' => 'required|array',
      'data.attributes' => 'required|array',
      'data.attributes.title' => ['required', 'string'],
      'data.attributes.short_description' => ['max:250', 'required', 'string'],
      'data.attributes.description' => ['required', 'string'],
      'data.attributes.salary' => ['required', 'string'],
      'data.attributes.location' => ['required', 'string'],
      'data.attributes.schedule' => [
        'required',
        'string',
        'in:Part-Time,Full-Time,Contract',
      ],
      'data.attributes.url' => ['required', 'url', 'string'],
      'data.attributes.featured' => ['boolean'],
      'data.attributes.tags' => ['sometimes'],
      'data.relationships.author.data.id' => [
        'required',
        'integer',
        'exists:Modules\Auth\Models\User,id',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function messages(): array {
    return [
      'data.attributes.schedule' => 'The data.attributes.schedule is invalid. Allowed values: Part-Time, Full-Time, and Contract.',
      'data.relationships.author.data.id' => 'The provided user id does not exist or invalid.',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function failedValidation(Validator $validator) {
    throw new HttpResponseException(response()->json([
      'success' => FALSE,
      'message' => 'Validation error',
      'errors' => $validator->errors(),
    ]));
  }

  /**
   * {@inheritdoc}
   */
  public function getMappedAttributes(array $additional_attributes = []): array {
    $income_attributes = [
      'title' => 'data.attributes.title',
      'featured' => 'data.attributes.featured',
      'schedule' => 'data.attributes.schedule',
      'salary' => 'data.attributes.salary',
      'location' => 'data.attributes.location',
      'description' => 'data.attributes.description',
      'short_description' => 'data.attributes.short_description',
      'url' => 'data.attributes.url',
    ];

    $attributes = [];
    foreach ($income_attributes as $model_column => $request_input) {
      if ($this->has($request_input)) {
        $attributes[$model_column] = $this->validated($request_input);
      }
    }

    return array_merge($attributes, $additional_attributes);
  }

}
