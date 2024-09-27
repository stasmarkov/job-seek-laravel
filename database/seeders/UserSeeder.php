<?php

declare(strict_types = 1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Modules\Auth\Enums\UserRolesEnum;
use Modules\Auth\Models\User;
use Modules\Employer\Models\EmployerProfile;
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
    $candidate_role = Role::firstOrNew(['name' => UserRolesEnum::CANDIDATE->value]);

    // Create admin user.
    User::factory()
      ->hasAttached($administrator_role)
      ->create([
        'name' => 'admin',
        'email' => 'admin@mail.com',
        'password' => env('ADMIN_PASSWORD') ?? '123456789',
        'status' => 1,
      ]);

    // Create employer user.
    User::factory()
      ->hasAttached($employer_role)
      ->has(EmployerProfile::factory())
      ->create([
        'name' => 'employer',
        'email' => 'employer@mail.com',
        'password' => env('EMPLOYER_PASSWORD') ?? '123456789',
        'status' => 1,
      ]);

    // Create candidate user.
    User::factory()
      ->hasAttached($candidate_role)
//      ->has(CandidateProfile::factory())
      ->create([
        'name' => 'candidate',
        'email' => 'candidate@mail.com',
        'password' => env('CANDIDATE_PASSWORD') ?? '123456789',
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
