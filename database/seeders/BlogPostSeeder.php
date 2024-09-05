<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;

/**
 * The blog post seeder.
 */
class BlogPostSeeder extends Seeder {

  /**
   * Run the database seeds.
   */
  public function run($users): void {
    $blogs = BlogPost::factory(20)
      ->recycle($users)
      ->create();
    Comment::factory(50)
      ->recycle($users)
      ->recycle($blogs)
      ->create();
  }

}
