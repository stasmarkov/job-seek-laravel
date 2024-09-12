<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRolesEnum;
use App\Models\EmployerProfile;
use App\Models\User;

/**
 * Provides the employer policy.
 */
class EmployerProfilePolicy {

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool {
    return $user->hasPermissionTo('view any employerProfile');
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, EmployerProfile $employerProfile): bool {
    if ($user->hasPermissionTo('view any employerProfile')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('view own employerProfile')) {
      return $user->id === $employerProfile->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool {
    return $user->hasPermissionTo('create a new employerProfile');
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, EmployerProfile $employerProfile): bool {
    return TRUE;

    if ($user->hasPermissionTo('edit any employerProfile')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('edit own employerProfile')) {
      return $user->id === $employerProfile->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, EmployerProfile $employerProfile): bool {
    if ($user->hasPermissionTo('delete any employerProfile')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('delete own employerProfile')) {
      return $user->id === $employerProfile?->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, EmployerProfile $employerProfile): bool {
    return $user->hasRole(UserRolesEnum::ADMIN);
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, EmployerProfile $employerProfile): bool {
    return $user->hasRole(UserRolesEnum::ADMIN);
  }

}
