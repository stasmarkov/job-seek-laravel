<?php

declare(strict_types = 1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

/**
 * The permissions seeder.
 */
class PermissionSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run(): void {
    Permission::create(['name' => 'create a new job']);
    Permission::create(['name' => 'edit any job']);
    Permission::create(['name' => 'edit own job']);
    Permission::create(['name' => 'delete any job']);
    Permission::create(['name' => 'delete own job']);

    Permission::create(['name' => 'create a new employer']);
    Permission::create(['name' => 'edit any employer']);
    Permission::create(['name' => 'edit own employer']);
    Permission::create(['name' => 'delete any employer']);
    Permission::create(['name' => 'delete own employer']);
  }

}
