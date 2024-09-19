<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * The Vacancy scope.
 */
class VacancyScope implements Scope {

  /**
   * Apply the scope to a given Eloquent query builder.
   */
  public function apply(Builder $builder, Model $model): void {}

}
