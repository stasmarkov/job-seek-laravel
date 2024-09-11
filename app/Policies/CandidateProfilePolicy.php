<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Enums\UserRolesEnum;
use App\Models\CandidateProfile;
use App\Models\User;

/**
 * Provides the employer policy.
 */
class CandidateProfilePolicy {

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool {
    return $user->hasPermissionTo('view any candidateProfile');
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, CandidateProfile $candidateProfile): bool {
    if ($user->hasPermissionTo('view any candidateProfile')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('view own candidateProfile')) {
      return $user->id === $candidateProfile->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool {
    return $user->hasPermissionTo('create a new candidateProfile') && !$user->candidateProfile()->first();
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user): bool {
    return TRUE;

    if ($user->hasPermissionTo('edit any candidateProfile')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('edit own candidateProfile')) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, CandidateProfile $candidateProfile): bool {
    if ($user->hasPermissionTo('delete any candidateProfile')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('delete own candidateProfile')) {
      return $user->id === $candidateProfile?->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, CandidateProfile $candidateProfile): bool {
    return $user->hasRole(UserRolesEnum::ADMIN);
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, CandidateProfile $candidateProfile): bool {
    return $user->hasRole(UserRolesEnum::ADMIN);
  }

}
