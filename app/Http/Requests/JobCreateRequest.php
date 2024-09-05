<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * The Job Create request.
 */
class JobCreateRequest extends FormRequest {

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'title' => ['required'],
      'short_description' => ['max:250', 'required'],
      'description' => ['required'],
      'salary' => ['required'],
      'location' => ['required'],
      'schedule' => [
        'required',
        Rule::in(['Part-Time', 'Full-Time', 'Contract']),
      ],
      'url' => ['required', 'active_url'],
      'tags' => ['nullable'],
    ];
  }

}
