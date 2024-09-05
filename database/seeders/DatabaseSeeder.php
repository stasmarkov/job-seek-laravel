<?php

declare(strict_types = 1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * The mai seeder.
 */
class DatabaseSeeder extends Seeder {

  /**
   * Seed the application's database.
   */
  public function run(): void {
    $this->call(PermissionSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(JobSeeder::class);
  }

}
