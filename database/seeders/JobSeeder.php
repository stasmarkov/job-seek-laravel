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
    $tags = Tag::factory(15)->create();

    Job::factory(50)
      ->recycle($users)
//      ->recycle($tags)
//      ->hasAttached($tags)
      ->create(new Sequence([
      'featured' => FALSE,
    ], [
      'featured' => TRUE,
    ]));
  }

}
