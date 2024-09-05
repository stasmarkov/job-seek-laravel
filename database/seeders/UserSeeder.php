<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\Employer;
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
    $administrator_role = Role::firstOrNew(['name' => 'Administrator']);
    $employer_role = Role::firstOrNew(['name' => 'Employer']);

    // Create admin user.
    User::factory()
      ->has(Employer::factory()->count(1))
      ->hasAttached($administrator_role)
      ->create([
        'name' => 'admin',
        'email' => 'admin@example.com',
        'password' => '123123123',
      ]);

    // Create Employer users.
    User::factory()
      ->count(10)
      ->create()
      ->each(function (User $user) use ($employer_role) {
        $user->roles()->save($employer_role);
      });
  }

}
