<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Vacancy\Http\Filters\V1\VacancyFilter;
use Modules\Vacancy\Http\Resources\V1\VacancyResource;
use Modules\Vacancy\Models\Vacancy;

class UserVacancyController extends ApiController {

  /**
   * Get vacancies of specific user.
   */
  public function index(int $user_id, VacancyFilter $filter): AnonymousResourceCollection {
    $vacancies = Vacancy::whereRelation('employerProfile', 'user_id', $user_id)->filter($filter);
    return VacancyResource::collection($vacancies->paginate());
  }

}
