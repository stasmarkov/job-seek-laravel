<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

/**
 * The job controller.
 */
class JobController extends Controller {

  /**
   * {@inheritdoc}
   */
  public static function middleware() {
    return [
      new Middleware('can:create,\App\Model\Job', only: ['create', 'store']),
      new Middleware('can:update,job', only: ['edit', 'update']),
      new Middleware('can:delete,job', only: ['destroy']),
    ];
  }

  /**
   * The job view page.
   *
   * @param \App\Models\Job $job
   *   The view job.
   *
   * @return \Inertia\Response
   *   The page.
   */
  public function index(Job $job) {
    $job->employer;
    $job->tags;
    return Inertia::render('Model/Job/View', [
      'job' => $job,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request) {
    return Inertia::render('Model/Job/CreateForm', [
      'employer' => Auth::user()->employer,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    $attributes = $request->validate([
      'title' => ['required'],
      'description' => ['required'],
      'salary' => ['required'],
      'location' => ['required'],
      'schedule' => ['required', Rule::in(['Part-Time', 'Full-Time', 'Contract'])],
      'url' => ['required', 'active_url'],
      'tags' => ['nullable'],
    ]);

    $attributes['featured'] = $request->has('featured');

    $job = Auth::user()->employer->jobs()
      ->create(Arr::except($attributes, 'tags'));

    if ($attributes['tags'] ?? FALSE) {
      foreach (explode(',', $attributes['tags']) as $tag) {
        $job->tag($tag);
      }
    }

    return back();
  }

}
