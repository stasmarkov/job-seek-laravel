<?php

declare(strict_types = 1);

namespace Modules\Candidate\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * The Employer Profile model request.
 */
class CandidateProfileRequest extends FormRequest {

  /**
   * The user to whom the candidate profile belongs.
   *
   * @var \App\Models\User
   */
  protected User $owner;

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'first_name' => ['required'],
      'last_name' => ['required'],
      'description' => ['required', 'min:100'],
      'experience_since' => ['int', 'min:1900'],
      'tags' => ['nullable'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner(): User {
    return $this->user;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(User $user): void {
    $this->user = $user;
  }

}
