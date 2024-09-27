<?php

declare(strict_types=1);

namespace Modules\Auth\Enums;

/**
 * Provides different type of users.
 */
enum UserRolesEnum: string {

  /**
   * The administrator role.
   */
  case ADMIN = 'administrator';

  /**
   * The employer role.
   */
  case EMPLOYER = 'employer';

  /**
   * The candidate role.
   */
  case CANDIDATE = 'candidate';

  /**
   * The content admin role.
   */
  case CONTENT_ADMIN = 'content_admin';

  /**
   * Get names.
   *
   * @return string
   *   The label of the
   */
  public function label(): string {
    return match ($this) {
      static::ADMIN => 'Administrator',
      static::EMPLOYER => 'Employer',
      static::CANDIDATE => 'Candidate',
      static::CONTENT_ADMIN => 'Content Administrator',
    };
  }

}
