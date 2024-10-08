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
    // Permissions related to Vacancy Model.
    Permission::create(['name' => 'view list of vacancies']);
    Permission::create(['name' => 'create a new vacancy']);
    Permission::create(['name' => 'create any new vacancy']);
    Permission::create(['name' => 'edit any vacancy']);
    Permission::create(['name' => 'edit own vacancy']);
    Permission::create(['name' => 'delete any vacancy']);
    Permission::create(['name' => 'delete own vacancy']);

    // Permissions related to EmployerProfile Model.
    Permission::create(['name' => 'view any employerProfile']);
    Permission::create(['name' => 'view own employerProfile']);
    Permission::create(['name' => 'create a new employerProfile']);
    Permission::create(['name' => 'edit any employerProfile']);
    Permission::create(['name' => 'edit own employerProfile']);
    Permission::create(['name' => 'delete any employerProfile']);
    Permission::create(['name' => 'delete own employerProfile']);

    // Permissions related to CandidateProfile Model.
    Permission::create(['name' => 'view any candidateProfile']);
    Permission::create(['name' => 'view own candidateProfile']);
    Permission::create(['name' => 'create a new candidateProfile']);
    Permission::create(['name' => 'edit any candidateProfile']);
    Permission::create(['name' => 'edit own candidateProfile']);
    Permission::create(['name' => 'delete any candidateProfile']);
    Permission::create(['name' => 'delete own candidateProfile']);
  }

}
