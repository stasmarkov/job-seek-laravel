<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\EmployerProfile;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * The job model seeder.
 */
class JobSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run(): void {
    // Create tags.
    Tag::factory(25)->create();

    $users = Role::firstOrNew(['name' => UserRolesEnum::EMPLOYER->value])
      ->users()
      ->with('employerProfile')
      ->get();
    $employer_profiles = EmployerProfile::all();

    Job::factory(1000)
      ->recycle($employer_profiles)
      ->recycle($users)
      ->create(new Sequence(
        ['featured' => FALSE],
        ['featured' => TRUE]
      ));
  }

}
