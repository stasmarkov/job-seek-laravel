<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Enums\UserRolesEnum;
use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * The Vacancy Mode policy.
 */
class VacancyPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool {
    return $user->hasPermissionTo('view list of vacancies');
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, Vacancy $vacancy): bool {
    return TRUE;
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool {
    return $user->hasPermissionTo('create a new vacancy') && $user->employerProfile()->first();
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, Vacancy $vacancy): bool {
    if ($user->hasPermissionTo('edit any vacancy')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('edit own vacancy')) {
      return $user->id === $vacancy?->employerProfile?->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Vacancy $vacancy): bool {
    if ($user->hasPermissionTo('delete any vacancy')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('delete own vacancy')) {
      return $user->id === $vacancy?->employerProfile?->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, Vacancy $vacancy): bool {
    return $user->hasRole(UserRolesEnum::ADMIN);
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, Vacancy $vacancy): bool {
    return $user->hasRole(UserRolesEnum::ADMIN);
  }

}
