<?php

declare(strict_types = 1);

namespace Modules\Auth\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest {

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool {
    return false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'email' => ['required', 'email'],
      'password' => ['required', 'min:6'],
    ];
  }

}
