<?php

declare(strict_types=1);

namespace Modules\Candidate\Policies;

use App\Enums\UserRolesEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Auth\Models\User;
use Modules\Candidate\Models\CandidateProfile;

/**
 * Provides the employer policy.
 */
class CandidateProfilePolicy {
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool {
    return $user->hasPermissionTo('view any candidateProfile');
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, CandidateProfile $candidate_profile): bool {
    if ($user->hasPermissionTo('view any candidateProfile')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('view own candidateProfile')) {
      return $user->id === $candidate_profile->user_id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user, CandidateProfile $candidate_profile = NULL): bool {
    return $user->hasPermissionTo('create a new candidateProfile') && !$candidate_profile;
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, CandidateProfile $candidate_profile): bool {
    if (!$candidate_profile) {
      return FALSE;
    }

    if ($user->hasPermissionTo('edit any candidateProfile')) {
      return TRUE;
    }

    if ($user->hasPermissionTo('edit own candidateProfile')) {
      return $candidate_profile->user->id === $user->id;
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
      return $candidate_profile->user->id === $user->id;
    }

    return FALSE;
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, CandidateProfile $candidateProfile): bool {
    return TRUE;

    return $user->hasRole(UserRolesEnum::ADMIN);
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, CandidateProfile $candidateProfile): bool {
    return TRUE;

    return $user->hasRole(UserRolesEnum::ADMIN);
  }

}
