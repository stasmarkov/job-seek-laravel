<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\JobPostedEvent;
use App\Events\JobViewedEvent;
use App\Http\Resources\JobResource;
use App\Http\Resources\TagResource;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

/**
 * The job controller.
 */
class JobController extends Controller implements HasMiddleware {

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
    $user = Auth::user();

    broadcast(new JobViewedEvent($job))->toOthers();

    return Inertia::render('Model/Job/View', [
      'job' => JobResource::make($job),
      'can' => [
        'edit' => $user ? $user->can('update', $job) : FALSE,
      ],
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request) {
    return Inertia::render('Model/Job/CreateForm', [
      'employer' => Context::get('current_user_employer'),
      'tags' => TagResource::collection(Tag::all()),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    // @todo Move to the separate shared storage.
    $attributes = $request->validate([
      'title' => ['required'],
      'short_description' => ['max:250', 'required'],
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
      $job->tags()->detach();
      if (\is_string($attributes['tags'])) {
        $attributes['tags'] = explode(',', $attributes['tags']);
      }

      foreach ($attributes['tags'] as $tag) {
        if ($loaded_tag = Tag::find($tag)) {
          $job->tag($loaded_tag->name);
        }
      }
    }

    // @todo Add if posted/draft functionality, but for testing it's ok.
    broadcast(new JobPostedEvent($job))->toOthers();
    return redirect(route('job.index', ['job' => $job->id]));
  }

  /**
   * The edit Job Model page.
   *
   * @param \App\Models\Job $job
   *   The Job model.
   *
   * @return \Inertia\Response
   *   The page.
   */
  public function edit(Job $job) {
    return Inertia::render('Model/Job/EditForm', [
      // @todo Retrieve from the context.
      'employer' => Context::get('current_user_employer'),
      'job' => JobResource::make($job),
      'tags' => TagResource::collection(Tag::all()),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(Request $request, Job $job) {
    // @todo Move to the separate shared storage.
    $attributes = $request->validate([
      'title' => ['required'],
      'short_description' => ['max:250', 'required'],
      'description' => ['required'],
      'salary' => ['required'],
      'location' => ['required'],
      'schedule' => ['required', Rule::in(['Part-Time', 'Full-Time', 'Contract'])],
      'url' => ['required', 'active_url'],
      'tags' => ['nullable'],
    ]);

    $attributes['featured'] = $request->has('featured');

    if ($attributes['tags'] ?? FALSE) {
      $job->tags()->detach();
      if (\is_string($attributes['tags'])) {
        $attributes['tags'] = explode(',', $attributes['tags']);
      }

      foreach ($attributes['tags'] as $tag) {
        if ($loaded_tag = Tag::find($tag)) {
          $job->tags()->attach($loaded_tag);
        }
      }
    }

    unset($attributes['tags']);
    $job->update($attributes);

    return redirect(route('job.index', [
      'job' => $job,
    ]));
  }

}
