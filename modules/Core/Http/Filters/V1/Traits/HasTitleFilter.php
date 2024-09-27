<?php

declare(strict_types=1);

namespace Modules\Core\Http\Filters\V1\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasTitleFilter {

  /**
   * Filter by title column.
   *
   * @param string $value
   *   The filter value.
   */
  public function title(string $value): Builder {
    $like_string = str_replace('*', '%', $value);
    return $this->builder->where('title', 'LIKE', $like_string);
  }

}
