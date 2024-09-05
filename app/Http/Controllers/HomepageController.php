<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Http\Resources\TagResource;
use App\Models\Job;
use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/**
 * The homepage controller class.
 */
class HomepageController extends Controller {

  /**
   * The homepage controller.
   *
   * @return mixed
   *   The Inertia render page.
   */
  public function index() {
    $jobs_featured = Job::latest()
      ->with(['employer', 'tags'])
      ->where('featured', TRUE)
      ->limit(6)
      ->get();

    $jobs = Job::latest()
      ->with(['employer', 'tags'])
      ->where('featured', FALSE)
      ->limit(9)
      ->get();

    return Inertia::render('Homepage', [
      'canLogin' => Route::has('login'),
      'canRegister' => Route::has('register'),
      'laravelVersion' => Application::VERSION,
      'phpVersion' => PHP_VERSION,
      'featuredJobs' => JobResource::collection($jobs_featured),
      'jobs' => JobResource::collection($jobs),
      'tags' => TagResource::collection(Tag::all()),
    ]);
  }

}
