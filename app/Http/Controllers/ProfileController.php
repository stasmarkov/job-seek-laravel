<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Models\CandidateProfile;
use App\Models\EmployerProfile;
use App\Models\User;
use Filament\Panel\Concerns\HasAuth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

/**
 * The profile controller.
 */
class ProfileController extends Controller {

  use AuthorizesRequests;

  /**
   * The edit page.
   *
   * @param \App\Models\User $user
   *   The user model.
   */
  public function edit(User $user) {
    if ($user->hasRole(UserRolesEnum::EMPLOYEE)) {
      return Inertia::render('Model/Candidate/UpdateForm', [
        'user' => $user,
        'candidateProfile' => $user->candidateProfile,
      ]);
    }

    if ($user->hasRole(UserRolesEnum::EMPLOYER)) {
      return Inertia::render('Model/Employer/UpdateForm', [
        'user' => $user,
        'employerProfile' => $user->employerProfile,
      ]);
    }

    abort(404);
  }

}
