<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\CandidateProfile;
use App\Models\EmployerProfile;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * The vacancy model seeder.
 */
class CandidateProfileSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run(): void {
    $candidate_role = Role::firstOrNew(['name' => UserRolesEnum::CANDIDATE->value]);

    // Create Candidates users.
    User::factory()
      ->count(500)
      ->has(CandidateProfile::factory())
      ->create([
        'status' => 1,
      ])
      ->each(function (User $user) use ($candidate_role) {
        $user->roles()->attach($candidate_role);
      });
  }

}
