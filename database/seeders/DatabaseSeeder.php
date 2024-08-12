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
      'email' => 'admin@example.com',
      'password' => '123123123',
    ]);

    User::factory(5)->create();
    $this->call(JobSeeder::class);
    $this->call(BlogPostSeeder::class);
  }

}
