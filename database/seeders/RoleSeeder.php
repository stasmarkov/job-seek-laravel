<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * The role seeder.
 */
class RoleSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run(): void {
    $admin = Role::findOrCreate(UserRolesEnum::ADMIN->value);
    $admin->syncPermissions([
      'create a new job',
      'edit any job',
      'edit own job',
      'delete any job',
      'delete own job',
      'view list of jobs',
      'view any employerProfile',
      'view own employerProfile',
      'create a new employerProfile',
      'edit any employerProfile',
      'edit own employerProfile',
      'delete any employerProfile',
      'delete own employerProfile',
      'view any candidateProfile',
      'view own candidateProfile',
      'create a new candidateProfile',
      'edit any candidateProfile',
      'edit own candidateProfile',
      'delete any candidateProfile',
      'delete own candidateProfile',
    ]);

    $employer = Role::findOrCreate(UserRolesEnum::EMPLOYER->value);
    $employer->syncPermissions([
      'create a new job',
      'edit own job',
      'delete own job',
      'view list of jobs',
      'create a new employerProfile',
      'edit own employerProfile',
      'delete own employerProfile',
    ]);

    $employee = Role::findOrCreate(UserRolesEnum::EMPLOYEE->value);
    $employee->syncPermissions([
      'create a new job',
      'edit own job',
      'delete own job',
      'view list of jobs',
      'create a new candidateProfile',
      'edit own candidateProfile',
      'delete own candidateProfile',
    ]);

    Role::findOrCreate(UserRolesEnum::CONTENT_ADMIN->value);
  }

}
