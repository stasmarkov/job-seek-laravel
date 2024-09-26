<?php

declare(strict_types=1);

namespace Modules\Vacancy\Http\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Http\Filters\V1\QueryFilter;
use Modules\Core\Http\Filters\V1\Traits\HasDateFilter;
use Modules\Core\Http\Filters\V1\Traits\HasTitleFilter;

/**
 * The endpoint filter.
 */
class VacancyFilter extends QueryFilter {

  /**
   * {@inheritdoc}
   */
  protected array $sortable = [
    'title',
    'shortDescription',
    'createdAt',
  ];

  use HasTitleFilter, HasDateFilter;

  /**
   * Filter by schedule.
   */
  public function schedule(string $value): Builder {
    return $this->builder->whereIn('schedule', explode(',', $value));
  }

  /**
   * Filter by schedule.
   */
  public function location($value): Builder {
    return $this->builder->where('location', $value);
  }

  /**
   * Filter by schedule.
   */
  public function featured($value): Builder {
    return $this->builder->where('featured', $value);
  }

  /**
   * Filter by schedule.
   */
  public function includeTags(): Builder {
    return $this->builder->with('tags');
  }

}
