<?php

declare(strict_types = 1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * The mai seeder.
 */
class DatabaseSeeder extends Seeder {
//  use WithoutModelEvents;

  /**
   * Seed the application's database.
   */
  public function run(): void {
    $this->call([
      PermissionSeeder::class,
      RoleSeeder::class,
      UserSeeder::class,
      VacancySeeder::class,
    ]);
  }

}
