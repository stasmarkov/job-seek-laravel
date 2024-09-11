<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CandidateProfileResource;
use App\Http\Resources\TagResource;
use App\Models\CandidateProfile;
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
class CandidateProfileController extends Controller implements HasMiddleware {

  /**
   * Constructs CandidateProfileController class.
   *
   * @param \Illuminate\Http\Request $request
   *   The request.
   */
  public function __construct(
    protected Request $request
  ) {}

  /**
   * {@inheritdoc}
   */
  public static function middleware() {
    return [
      new Middleware('can:create,\App\Model\CandidateProfile', only: [
        'create',
        'store',
      ]),
      //      new Middleware('can:update,candidateProfile', only: ['edit', 'update']),
      //      new Middleware('can:delete,candidateProfile', only: ['destroy']),
    ];
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

    if ($attributes['tags'] ?? FALSE) {
      $candidate_profile->tags()->detach();
      if (\is_string($attributes['tags'])) {
        $attributes['tags'] = explode(',', $attributes['tags']);
      }

      foreach ($attributes['tags'] as $tag) {
        if ($loaded_tag = Tag::find($tag)) {
          $candidate_profile->tag($loaded_tag->name);
        }
      }
    }

    return redirect()->route('account.edit', ['user' => $user->id]);
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

    if ($attributes['tags'] ?? FALSE) {
      $candidate_profile->tags()->detach();
      if (\is_string($attributes['tags'])) {
        $attributes['tags'] = explode(',', $attributes['tags']);
      }

      foreach ($attributes['tags'] as $tag) {
        if ($loaded_tag = Tag::find($tag)) {
          $candidate_profile->tag($loaded_tag->name);
        }
      }
    }

    unset($attributes['tags']);
    $candidate_profile->update(Arr::except($attributes, 'tags'));

    back();
  }

}
