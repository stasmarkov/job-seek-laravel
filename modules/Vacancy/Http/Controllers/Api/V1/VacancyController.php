<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Auth\Enums\UserRolesEnum;
use Modules\Auth\Models\User;
use Modules\Core\Traits\HasApiResponses;
use Modules\Vacancy\Http\Filters\V1\VacancyFilter;
use Modules\Vacancy\Http\Requests\Api\V1\ReplaceVacancyRequest;
use Modules\Vacancy\Http\Requests\Api\V1\StoreVacancyRequest;
use Modules\Vacancy\Http\Requests\Api\V1\UpdateVacancyRequest;
use Modules\Vacancy\Http\Resources\V1\VacancyResource;
use Modules\Vacancy\Models\Vacancy;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * The Vacancy API controller.
 */
class VacancyController extends ApiController {

  use HasApiResponses;

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
   * Display the specified resource.
   */
  public function show(int $vacancy_id): JsonResource|JsonResponse {
    try {
      $vacancy = Vacancy::findOrFail($vacancy_id);
      $this->authorize('viewAny', [$vacancy]);

      if ($this->include('tags')) {
        return new VacancyRaesource($vacancy?->load('tags'));
      }

      return VacancyResource::make($vacancy);
    }
    catch (ModelNotFoundException) {
      return $this->error('Vacancy cannot be found', 404);
    }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreVacancyRequest $request): JsonResource|JsonResponse {
    try {
      $owner = User::findOrFail($request->input('data.relationships.author.data.id'));
    }
    catch (ModelNotFoundException) {
      return $this->ok('User not found', [
        'error' => 'The provided user id does not exist.',
      ]);
    }

    $this->authorize('create', [Vacancy::class, $owner]);

    try {
      DB::beginTransaction();
      $attributes = [
        'uuid' => Str::uuid(),
        'employer_profile_id' => $owner->employerProfile->id,
      ];
      $vacancy = Vacancy::create($request->getMappedAttributes($attributes));
      DB::commit();
    }
    catch (\Exception $exception) {
      DB::rollBack();

      return $this->ok('Internal error', [
        'error' => 'Could not create a new vacancy. Please try again later.',
      ]);
    }

    return VacancyResource::make($vacancy);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateVacancyRequest $request, int $vacancy_id): JsonResource|JsonResponse {
    try {
      $vacancy = Vacancy::findOrFail($vacancy_id);
      $this->authorize('update', [$vacancy]);

      try {
        DB::beginTransaction();
        $vacancy?->update($request->getMappedAttributes());
        DB::commit();
      }
      catch (\Exception) {
        DB::rollBack();

        return $this->ok('Internal error', [
          'error' => 'Could not replace vacancy. Please try again later.',
        ]);
      }

      return VacancyResource::make($vacancy);
    }
    catch (ModelNotFoundException) {
      return $this->error('Vacancy cannot be found', 404);
    }
    catch (AuthorizationException $exception) {
      return $this->error('You are not authorized to perform this action.', 401);
    }
  }

  /**
   * Replace the specified resource in storage.
   */
  public function replace(ReplaceVacancyRequest $request, int $vacancy_id): JsonResource|JsonResponse {
    try {
      $vacancy = Vacancy::findOrFail($vacancy_id);
      $this->authorize('update', [$vacancy]);

      try {
        DB::beginTransaction();
        $vacancy?->update($request->getMappedAttributes());
        DB::commit();
      }
      catch (\Exception) {
        DB::rollBack();

        return $this->ok('Internal error', [
          'error' => 'Could not replace vacancy. Please try again later.',
        ]);
      }

      return VacancyResource::make($vacancy);
    }
    catch (ModelNotFoundException) {
      return $this->error('Vacancy cannot be found', 404);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(int $vacancy_id): JsonResponse {
    try {
      $vacancy = Vacancy::findOrFail($vacancy_id);
      $this->authorize('delete', [$vacancy]);
      $vacancy?->delete();
      return $this->ok('Vacancy successfully deleted');
    }
    catch (ModelNotFoundException) {
      return $this->error('Vacancy cannot be found', 404);
    }
  }

}
