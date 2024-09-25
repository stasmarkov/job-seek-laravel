<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Http\Controllers\Api\V1;

use App\Enums\UserRolesEnum;
use App\Http\Controllers\ApiController;
use App\Traits\HasApiResponses;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Auth\Models\User;
use Modules\Vacancy\Http\Filters\V1\VacancyFilter;
use Modules\Vacancy\Http\Requests\Api\V1\StoreVacancyRequest;
use Modules\Vacancy\Http\Requests\Api\V1\UpdateVacancyRequest;
use Modules\Vacancy\Http\Resources\V1\VacancyResource;
use Modules\Vacancy\Models\Vacancy;

/**
 * The Vacancy API controller.
 */
class VacancyController extends ApiController {

  use HasApiResponses;

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->middleware('can:viewAny,\Modules\Vacancy\Models\Vacancy')->only('index');
    $this->middleware('can:update,vacancy')->only('update');
    $this->middleware('can:delete,vacancy')->only('destroy');
  }

  /**
   * Display a listing of the resource.
   */
  public function index(VacancyFilter $filters) {
    if (Auth::user() && Auth::user()?->hasRole(UserRolesEnum::EMPLOYER)) {
      return VacancyResource::collection(Vacancy::currentEmployer()->filter($filters)->paginate(10));
    }

    return VacancyResource::collection(Vacancy::filter($filters)->paginate(10));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreVacancyRequest $request) {
    try {
      $owner = User::findOrFail($request->input('data.relationships.author.data.id'));
    }
    catch (ModelNotFoundException $exception) {
      return $this->ok('User not found', [
        'error' => 'The provided user id does not exist.',
      ]);
    }

    $this->authorize('create', [Vacancy::class, $owner]);

    $model = [
      'uuid' => Str::uuid(),
      'title' => $request->validated('data.attributes.title'),
      'featured' => $request->validated('data.attributes.featured'),
      'schedule' => $request->validated('data.attributes.schedule'),
      'salary' => $request->validated('data.attributes.salary'),
      'location' => $request->validated('data.attributes.location'),
      'description' => $request->validated('data.attributes.description'),
      'short_description' => $request->validated('data.attributes.short_description'),
      'url' => $request->validated('data.attributes.url'),
      'employer_profile_id' => $owner->employerProfile->id,
    ];

    try {
      DB::beginTransaction();
      $vacancy = Vacancy::create($model);
      DB::commit();
    }
    catch (\Exception) {
      DB::rollBack();

      return $this->ok('Internal error', [
        'error' => 'Could not create a new vacancy. Please try again later.',
      ]);
    }

    return VacancyResource::make($vacancy);
  }

  /**
   * Display the specified resource.
   */
  public function show(Vacancy $vacancy) {
    if ($this->include('tags')) {
      return new VacancyResource($vacancy->load('tags'));
    }

    return VacancyResource::make($vacancy);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateVacancyRequest $request, Vacancy $vacancy) {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Vacancy $vacancy) {
    //
  }

}
