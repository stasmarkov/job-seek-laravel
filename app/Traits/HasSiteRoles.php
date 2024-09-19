<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Enums\UserRolesEnum;

/**
 * Helper trait to check if models has specific roles.
 */
trait HasSiteRoles {

  /**
   * Checks if user has an Admin role.
   */
  public function isAdmin(): bool {
    return $this->hasRole(UserRolesEnum::ADMIN);
  }

  /**
   * Checks if user has an Employer role.
   */
  public function isEmployer(): bool {
    return $this->hasRole(UserRolesEnum::EMPLOYER);
  }

  /**
   * Checks if user has an Candidate role.
   */
  public function isCandidate(): bool {
    return $this->hasRole(UserRolesEnum::CANDIDATE);
  }

}
