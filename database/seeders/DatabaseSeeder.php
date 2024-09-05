<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Employer;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

  /**
   * Seed the application's database.
   */
  public function run(): void {
    User::factory()
      ->has(Employer::factory()->count(1))
      ->create([
        'name' => 'admin',
        'email' => 'admin@example.com',
        'password' => '123123123',
      ]);

    User::factory()
      ->has(Employer::factory()->count(1))
      ->create([
      'name' => 'admin-2',
      'email' => 'admin-2@example.com',
      'password' => '123123123',
    ]);

    $users = User::factory(10)->create();
    $this->call(JobSeeder::class, FALSE, [
      'users' => $users,
    ]);
    $this->call(BlogPostSeeder::class, FALSE, [
      'users' => $users,
    ]);
    $this->call(ProfileSeeder::class, FALSE, [
      'users' => $users,
    ]);
  }

}
