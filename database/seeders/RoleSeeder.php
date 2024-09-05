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
    $admin->givePermissionTo([
      'create a new job',
      'edit any job',
      'edit own job',
      'delete any job',
      'delete own job',
    ]);

    $employer = Role::findOrCreate(UserRolesEnum::EMPLOYER->value);
    $employer->givePermissionTo([
      'create a new job',
      'edit own job',
      'delete own job',
    ]);

    Role::findOrCreate(UserRolesEnum::EMPLOYEE->value);
    Role::findOrCreate(UserRolesEnum::CONTENT_ADMIN->value);
  }

}
