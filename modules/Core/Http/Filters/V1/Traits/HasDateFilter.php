<?php

declare(strict_types=1);

namespace Modules\Core\Http\Filters\V1\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * {@inheritdoc}
 */
trait HasDateFilter {

  /**
   * Filter by created_at column.
   *
   * @param string $created_at
   *   The created at value.
   */
  public function createdAt(string $created_at): Builder {
    $dates = explode(',', $created_at);

    if (\count($dates) > 1) {
      return $this->builder->whereBetween('created_at', $dates);
    }

    return $this->builder->whereDate('created_at', $created_at);
  }

  /**
   * Filter by updated_at column.
   *
   * @param string $updated_at
   *   The updated at value.
   */
  public function updatedAt(string $updated_at): Builder {
    $dates = explode(',', $updated_at);

    if (\count($dates) > 1) {
      return $this->builder->whereBetween('updated_at', $dates);
    }

    return $this->builder->whereDate('updated_at', $updated_at);
  }

}
