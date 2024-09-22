<?php

declare(strict_types=1);

namespace Modules\Candidate\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Modules\Candidate\Http\Requests\CandidateProfileRequest;
use Modules\Candidate\Http\Resources\CandidateProfileResource;
use Modules\Candidate\Jobs\CreateCandidate;
use Modules\Candidate\Jobs\UpdateCandidate;
use Modules\Vacancy\Jobs\CreateVacancy;

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
    $this->middleware('can:create,\Modules\Candidate\Models\CandidateProfile')->only('create', 'store');
    $this->middleware('can:update,\Modules\Candidate\Models\CandidateProfile')->only('edit', 'update');
    $this->middleware('can:delete,\Modules\Candidate\Models\CandidateProfile')->only('destroy');
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
  public function store(CandidateProfileRequest $request, User $user) {
    $request->validated($request->all());

    $request->setOwner($user);
    $uuid = Str::uuid();
    $this->dispatchSync(CreateCandidate::fromRequest($request, $uuid));
    return redirect()->route('candidate_profile.show', ['user' => $user->id]);
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
  public function update(CandidateProfileRequest $request, User $user) {
    $request->validated($request->all());

    $request->setOwner($user);
    $uuid = Str::uuid();
    $this->dispatchSync(UpdateCandidate::fromRequest($request, $uuid));
    return back();
  }

}
