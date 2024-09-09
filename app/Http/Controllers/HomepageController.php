<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Http\Resources\TagResource;
use App\Models\Job;
use App\Models\Scopes\JobScope;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
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
    $jobs_featured = Cache::remember('views:jobs:homepage:featured', 3600, static function () {
      return Job::latest()
        ->withoutGlobalScope(JobScope::class)
        ->select('id', 'title', 'short_description', 'featured', 'salary', 'schedule')
        ->with(['employer', 'tags'])
        ->where('featured', TRUE)
        ->limit(6)
        ->get();
    });

    $jobs = Cache::remember('views:jobs:homepage:non-featured', 3600, static function () {
      return Job::latest()
        ->withoutGlobalScope(JobScope::class)
        ->with(['employer', 'tags'])
        ->where('featured', FALSE)
        ->limit(9)
        ->get();
    });

    $tags = Cache::remember('tags:all', 3600, static function () {
      return Tag::all();
    });

    return Inertia::render('Homepage', [
      'canLogin' => Route::has('login'),
      'canRegister' => Route::has('register'),
      'laravelVersion' => Application::VERSION,
      'phpVersion' => PHP_VERSION,
      'featuredJobs' => JobResource::collection($jobs_featured),
      'jobs' => JobResource::collection($jobs),
      'tags' => TagResource::collection($tags),
    ]);
  }

}
