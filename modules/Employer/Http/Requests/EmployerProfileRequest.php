<?php

declare(strict_types = 1);

namespace Modules\Employer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

/**
 * The Employer Profile model request.
 */
class EmployerProfileRequest extends FormRequest {

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'name' => ['required'],
      'logo' => ['required', File::types(['png', 'webp', 'jpg', 'jpeg'])],
    ];
  }

}
