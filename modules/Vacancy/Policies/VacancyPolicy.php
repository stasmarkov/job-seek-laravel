<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Auth\Enums\UserRolesEnum;
use Modules\Auth\Models\User;
use Modules\Vacancy\Models\Vacancy;

/**
 * The Vacancy Mode policy.
 */
class VacancyPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool {
    return TRUE;
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user): bool {
    return TRUE;
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user, User $owner): bool {
    if ($user->isAdmin()) {
      return TRUE;
    }

    return
      ($user->hasPermissionTo('create any new vacancy') && $owner->employerProfile()->first()) ||
      ($user->hasPermissionTo('create a new vacancy') && $user->is($owner) && $user->employerProfile()->first());
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
