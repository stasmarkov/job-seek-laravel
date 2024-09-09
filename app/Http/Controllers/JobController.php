<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Http\Requests\JobCreateRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Http\Resources\JobResource;
use App\Http\Resources\TagResource;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
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
      new Middleware('can:viewAny,\App\Model\Job', only: ['index']),
      new Middleware('can:create,\App\Model\Job', only: ['create', 'store']),
      new Middleware('can:update,job', only: ['edit', 'update']),
      new Middleware('can:delete,job', only: ['destroy']),
    ];
  }

  /**
   * Get the list of all jobs.
   *
   * @return \Inertia\Response
   */
  public function index() {
    $user = Auth::user();
    $jobs = Job::query()
      ->with(['employer', 'tags']);

    if (!$user?->hasRole(UserRolesEnum::ADMIN->value)) {
      $jobs->whereRelation('employer', 'user_id', '=', $user?->id);
    }

    $jobs = $jobs
      ->paginate(10)
      ->withQueryString();

    return Inertia::render('Model/Job/List', [
      'jobs' => $jobs,
    ]);
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
  public function show(Request $request, Job $job) {
    $user = Auth::user();
    $reactantFacade = $job->viaLoveReactant();

    return Inertia::render('Model/Job/View', [
      'job' => JobResource::make($job),
      'likesCount' => $reactantFacade->getReactionCounterOfType('Like')->getCount(),
      'isLiked' => $reactantFacade->isReactedBy($user, 'Like'),
      'can' => [
        'edit_job' => $user ? $user->can('update', $job) : FALSE,
        'create_job' => Auth::user()?->can('create', Job::class),
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
  public function store(JobCreateRequest $request) {
    // @todo Move to the separate shared storage.
    $attributes = $request->validated();
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

    return redirect(route('job.show', ['job' => $job->id]));
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
      'employer' => Context::get('current_user_employer'),
      'job' => JobResource::make($job),
      'tags' => TagResource::collection(Tag::all()),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(JobUpdateRequest $request, Job $job) {
    $attributes = $request->validated();

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

    return redirect(route('job.show', [
      'job' => $job,
    ]));
  }

  /**
   * React on the like/dislike click.
   */
  public function like(Job $job) {
    $user = Auth::user();
    $reacterFacade = $user?->viaLoveReacter();

    if ($reacterFacade->hasNotReactedTo($job, 'Like')) {
      $reacterFacade->reactTo($job, 'Like');
    }
    else {
      $reacterFacade->unreactTo($job, 'Like');
    }

    return back();
  }

}
