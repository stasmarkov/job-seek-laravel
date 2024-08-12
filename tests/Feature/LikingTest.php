<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
 use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikingTest extends TestCase {

  use RefreshDatabase;

  /**
   * A basic feature test example.
   */
  public function test_blog_post_can_be_liked(): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    $blog_post = BlogPost::factory()->create();
    $blog_post->like();

    $this->assertCount(1, $blog_post->likes);
    $this->assertTrue($blog_post->likes->contains('id', \Auth::user()->id));
  }

  public function test_comment_can_be_liked():  void {
    $user = User::factory()->create();
    $this->actingAs($user);

    $comment = Comment::factory()->create();
    $comment->like();

    $this->assertCount(1, $comment->likes);
    $this->assertTrue($comment->likes->contains('id', \Auth::user()->id));
  }

}
