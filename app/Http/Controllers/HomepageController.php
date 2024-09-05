<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

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
      'featuredJobs' => $jobs_featured->map(fn($job) => [
        'title' => $job->title,
        'url' => $job->url,
        'schedule' => $job->schedule,
        'salary' => $job->salary,
        'tags' => $job->tags->map(fn($tag) => [
          'name' => $tag->name,
        ]),
        'employer' => [
          'name' => $job->employer->name,
          'logo' => $job->employer->logo,
        ],
      ]),
      'jobs' => $jobs->map(fn($job) => [
        'title' => $job->title,
        'url' => $job->url,
        'schedule' => $job->schedule,
        'salary' => $job->salary,
        'tags' => $job->tags->map(fn($tag) => [
          'name' => $tag->name,
        ]),
        'employer' => [
          'name' => $job->employer->name,
          'logo' => $job->employer->logo,
        ],
      ]),
      'tags' => Tag::all()->map(fn($tag) => [
        'name' => $tag->name,
      ]),
    ]);
  }

}
