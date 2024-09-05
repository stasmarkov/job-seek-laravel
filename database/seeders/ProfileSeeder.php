<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run(): void {
    Profile::factory()->has(User::factory())->createMany(10);
  }

}
