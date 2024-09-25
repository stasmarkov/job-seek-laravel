<?php

declare(strict_types=1);

namespace Modules\Vacancy\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * {@inheritdoc}
 */
class StoreVacancyRequest extends FormRequest {

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
      'data.attributes.tags' => ['nullable'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function messages(): array {
    return [
      'data.attributes.schedule' => 'The data.attributes.schedule is invalid. Allowed values: Part-Time, Full-Time, and Contract.',
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

}
