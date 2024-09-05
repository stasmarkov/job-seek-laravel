<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * Provides the employer policy.
 */
class EmployerPolicy {

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool {
    return TRUE;
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, Employer $employer): bool {
    return $user->id === $employer->user_id || $user->id === 1;
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool {
    return (bool) $user->id;
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, Employer $employer): bool {
    return $user->id === $employer->user_id || $user->id === 1;
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Employer $employer): bool {
    return $user->id === $employer->user_id || $user->id === 1;
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, Employer $employer): bool {
    return $user->id === 1;
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, Employer $employer): bool {
    return $user->id === 1;
  }

}
