<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run(): void {
    BlogPost::factory(10)->create();
  }

}
