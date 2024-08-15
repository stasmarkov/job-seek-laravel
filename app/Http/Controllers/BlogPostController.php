<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller {

  /**
   * Display a listing of the resource.
   */
  public function index() {
    return view('blog_post.index', [
      'blog_posts' => BlogPost::orderBy('created_at', 'DESC')->paginate(10),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    //
  }

  /**
   * Display the specified resource.
   */
  public function like(BlogPost $blog_post) {
    $blog_post->like();
    return redirect()->route('blog.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(BlogPost $blog_post) {
    return view('blog_post.show', [
      'blog_post' => $blog_post,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(BlogPost $blogPost) {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, BlogPost $blogPost) {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(BlogPost $blogPost) {
    //
  }

}
