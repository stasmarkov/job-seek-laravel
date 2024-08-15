<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

  /**
   * Seed the application's database.
   */
  public function run(): void {
    User::factory()->create([
      'name' => 'admin',
      'email' => 'admin@example.com',
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
