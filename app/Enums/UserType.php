<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Provides different type of users.
 */
enum UserRole: string {

  /**
   * The administrator role.
   */
  case ADMIN = 'administrator';

  /**
   * The employer role.
   */
  case EMPLOYER = 'employer';

  /**
   * The employee role.
   */
  case EMPLOYEE = 'employee';

  /**
   * The content admin role.
   */
  case CONTENT_ADMIN = 'content_admin';

}
