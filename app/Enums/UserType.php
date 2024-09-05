<?php

declare(strict_types = 1);

namespace App\Enums;

/**
 * Provides different type of users.
 */
enum UserType: string {

  case ANON = 'anonymous';
  case AUTH = 'authenticated';
  case ADMIN = 'administrator';

  case EMPLOYER = 'employer';

  case EMPLOYEE = 'employy';

}
