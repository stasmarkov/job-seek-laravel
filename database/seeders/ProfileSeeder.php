<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * The profile seeder.
 */
class ProfileSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run(): void {
    Profile::factory()->has(User::factory())->createMany(10);
  }

}
