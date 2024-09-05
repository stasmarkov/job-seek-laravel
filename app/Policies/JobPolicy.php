<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * The Job Mode policy.
 */
class JobPolicy {

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool {
    return TRUE;
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
    return (int) $user->id === 1;
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, Job $job): bool {
    return $user->id === $job?->employer?->user_id || (int) $user->id === 1;
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Job $job): bool {
    return $user->id === $job?->employer?->user_id || (int) $user->id === 1;
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, Job $job): bool {
    return $user->id === 1;
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, Job $job): bool {
    return $user->id === 1;
  }

}
