<?php

declare(strict_types=1);

namespace Modules\Auth\Http\Filters\V1;

use App\Http\Filters\V1\QueryFilter;
use App\Http\Filters\V1\Traits\HasDateFilter;
use App\Http\Filters\V1\Traits\HasTitleFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * The endpoint filter.
 */
class UserFilter extends QueryFilter {

  use HasDateFilter;

  /**
   * Filter by id column.
   *
   * @param string $value
   *   The id value.
   */
  public function id(string $value) {
    return $this->builder->whereIn('id', explode(',', $value));
  }

  /**
   * Filter by email column.
   *
   * @param string $value
   *   The filter value.
   */
  public function email(string $value): Builder {
    $like_string = str_replace('*', '%', $value);
    return $this->builder->where('email', 'LIKE', $like_string);
  }

  /**
   * Filter by name column.
   *
   * @param string $value
   *   The filter value.
   */
  public function name(string $value): Builder {
    $like_string = str_replace('*', '%', $value);
    return $this->builder->where('name', 'LIKE', $like_string);
  }

}
