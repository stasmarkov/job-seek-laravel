<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\EmployerProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

/**
 * The user seeder.
 */
class UserSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run(Collection $users): void {
    $administrator_role = Role::firstOrNew(['name' => UserRolesEnum::ADMIN->value]);
    $employer_role = Role::firstOrNew(['name' => UserRolesEnum::EMPLOYER->value]);
    $employee_role = Role::firstOrNew(['name' => UserRolesEnum::EMPLOYEE->value]);

    // Create admin user.
    User::factory()
      ->hasAttached($administrator_role)
      ->create([
        'name' => 'admin',
        'email' => 'admin@mail.com',
        'password' => env('ADMIN_PASSWORD') ?? '123456789',
        'status' => 1,
      ]);

    // Create admin user.
    User::factory()
      ->hasAttached($employer_role)
      ->create([
        'name' => 'employer',
        'email' => 'employer@mail.com',
        'password' => env('EMPLOYER_PASSWORD') ?? '123456789',
        'status' => 1,
      ]);

    // Create admin user.
    User::factory()
      ->hasAttached($employee_role)
      ->create([
        'name' => 'employee',
        'email' => 'employee@mail.com',
        'password' => env('EMPLOYEE_PASSWORD') ?? '123456789',
        'status' => 1,
      ]);

    // Create Employer users.
    User::factory()
      ->count(10)
      ->has(EmployerProfile::factory())
      ->create([
        'status' => 1,
      ])
      ->each(function (User $user) use ($employer_role) {
        $user->roles()->attach($employer_role);
      });
  }

}
