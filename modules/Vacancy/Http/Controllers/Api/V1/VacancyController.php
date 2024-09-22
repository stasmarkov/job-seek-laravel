<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use Modules\Vacancy\Http\Requests\Api\V1\StoreVacancyRequest;
use Modules\Vacancy\Http\Requests\Api\V1\UpdateVacancyRequest;
use Modules\Vacancy\Http\Resources\V1\VacancyResource;
use Modules\Vacancy\Models\Vacancy;

/**
 * The Vacancy API controller.
 */
class VacancyController extends ApiController {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->middleware('can:viewAny,\Modules\Vacancy\Models\Vacancy')->only('index');
    $this->middleware('can:create,\Modules\Vacancy\Models\Vacancy')->only('store');
    $this->middleware('can:update,vacancy')->only('update');
    $this->middleware('can:delete,vacancy')->only('destroy');
  }

  /**
   * Display a listing of the resource.
   */
  public function index() {
    if ($this->include('tags')) {
      return VacancyResource::collection(Vacancy::with('tags')->paginate(50));
    }

    return VacancyResource::collection(Vacancy::query()->paginate(50));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreVacancyRequest $request) {
    //
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
