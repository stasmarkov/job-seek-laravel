<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Enums\UserRolesEnum;
use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * The Job Mode policy.
 */
class JobPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool {
    return $user->hasPermissionTo('view list of jobs');
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, Job $job): bool {
    return TRUE;
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool {
    return $user->hasPermissionTo('create a new job');
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, Job $job): bool {
    if ($user->hasPermissionTo('edit any job')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('edit own job')) {
      return $user->id === $job?->employerProfile?->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Job $job): bool {
    if ($user->hasPermissionTo('delete any job')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('delete own job')) {
      return $user->id === $job?->employerProfile?->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, Job $job): bool {
    return $user->hasRole(UserRolesEnum::ADMIN);
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, Job $job): bool {
    return $user->hasRole(UserRolesEnum::ADMIN);
  }

}
