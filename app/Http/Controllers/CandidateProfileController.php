<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CandidateProfileResource;
use App\Http\Resources\EmployerProfileResource;
use App\Http\Resources\VacancyResource;
use App\Http\Resources\TagResource;
use App\Models\CandidateProfile;
use App\Models\EmployerProfile;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Arr;
use Inertia\Inertia;

/**
 * The Candidate Profile model controller.
 */
class CandidateProfileController extends Controller {

  /**
   * Constructs CandidateProfileController class.
   *
   * @param \Illuminate\Http\Request $request
   *   The request.
   */
  public function __construct(
    protected Request $request
  ) {
    $this->middleware('can:create,\App\Model\CandidateProfile')->only('create', 'store');
    $this->middleware('can:update,\App\Model\CandidateProfile')->only('edit', 'update');
    $this->middleware('can:delete,\App\Model\CandidateProfile')->only('destroy');
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user) {
    if (!$user->candidateProfile()->first()) {
      abort(403);
    }
    return Inertia::render('Model/CandidateProfile/View', [
      'candidateProfile' => CandidateProfileResource::make($user->candidateProfile, $user->candidateProfile->tags),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function create(User $user) {
    return Inertia::render('Model/CandidateProfile/CreateForm', [
      'user' => $user,
      'tags' => TagResource::collection(Tag::all('id', 'name')),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(User $user) {
    $attributes = $this->request->validate([
      'first_name' => ['required'],
      'last_name' => ['required'],
      'description' => ['required'],
      'experience_since' => ['int'],
      'tags' => ['nullable']
    ]);

    $candidate_profile = $user->candidateProfile()
      ->create(Arr::except($attributes, 'tags'));

    if (\is_string($attributes['tags'])) {
      $attributes['tags'] = explode(',', $attributes['tags']);
    }
    $candidate_profile->syncTags($attributes['tags']);

    return redirect()->route('profile.candidate.show', ['user' => $user->id]);
  }

  /**
   * {@inheritdoc}
   */
  public function edit(User $user) {
    $user->candidateProfile->tags();
    return Inertia::render('Model/CandidateProfile/UpdateForm', [
      'user' => $user,
      'candidateProfile' => CandidateProfileResource::make($user->candidateProfile),
      'tags' => TagResource::collection(Tag::all('id', 'name')),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(User $user) {
    $attributes = $this->request->validate([
      'first_name' => ['required'],
      'last_name' => ['required'],
      'description' => ['required'],
      'experience_since' => ['int'],
      'tags' => ['nullable'],
    ]);

    $candidate_profile = $user->candidateProfile;

    if (\is_string($attributes['tags'])) {
      $attributes['tags'] = explode(',', $attributes['tags']);
    }
    $candidate_profile->syncTags($attributes['tags']);

    unset($attributes['tags']);
    $candidate_profile->update(Arr::except($attributes, 'tags'));

    return back();
  }

}
