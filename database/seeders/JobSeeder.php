<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run($users): void {
    Job::factory(50)
      ->recycle($users)
      ->create(new Sequence([
      'featured' => FALSE,
    ], [
      'featured' => TRUE,
    ]));
  }

}
