<?php

declare(strict_types=1);

namespace Modules\Candidate\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Modules\Auth\Models\User;
use Modules\Candidate\Http\Requests\CandidateProfileRequest;
use Modules\Candidate\Http\Resources\CandidateProfileResource;
use Modules\Candidate\Jobs\CreateCandidate;
use Modules\Candidate\Jobs\UpdateCandidate;
use Modules\Candidate\Models\CandidateProfile;

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
  ) {}

  /**
   * Display the specified resource.
   */
  public function show(CandidateProfile $candidate_profile) {
    $this->authorize('view', [$candidate_profile]);

    return Inertia::render('Model/CandidateProfile/View', [
      'candidateProfile' => CandidateProfileResource::make($candidate_profile, $candidate_profile->tags),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function create(User $user) {
    if ($user->candidateProfile) {
      return redirect()->route('profile.candidate.edit', ['user' => $user->id]);
    }

    $this->authorize('create', [CandidateProfile::class]);

    return Inertia::render('Model/CandidateProfile/CreateForm', [
      'user' => $user,
      'tags' => TagResource::collection(Tag::all('id', 'name')),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CandidateProfileRequest $request, User $user) {
    $this->authorize('create', [CandidateProfile::class]);

    $request->validated($request->all());

    $request->setOwner($user);
    $uuid = Str::uuid();
    $this->dispatchSync(CreateCandidate::fromRequest($request, $uuid));
    return redirect()->route('profile.candidate.show', ['candidate_profile' => $user->candidateProfile->id]);
  }

  /**
   * {@inheritdoc}
   */
  public function edit(User $user) {
    if (!$user->candidateProfile) {
      return redirect()->route('profile.candidate.create', ['user' => $user->id]);
    }

    $this->authorize('update', [$user->candidateProfile]);

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
  public function update(CandidateProfileRequest $request, User $user) {
    $this->authorize('update', [$user->candidateProfile]);

    $request->validated($request->all());

    $request->setOwner($user);
    $uuid = Str::uuid();
    $this->dispatchSync(UpdateCandidate::fromRequest($request, $uuid));
    return back();
  }

}
