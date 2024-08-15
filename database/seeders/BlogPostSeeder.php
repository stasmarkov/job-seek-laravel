<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

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
