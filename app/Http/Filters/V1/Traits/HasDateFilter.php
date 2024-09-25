<?php

declare(strict_types=1);

namespace App\Http\Filters\V1\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasDateFilter {

  /**
   * Filter by created_at column.
   *
   * @param string $value
   *
   * @return mixed
   */
  public function createdAt(string $value): Builder {
    $dates = explode(',', $value);

    if (\count($dates) > 1) {
      return $this->builder->whereBetween('created_at', $dates);
    }

    return $this->builder->whereDate('created_at', $value);
  }


  /**
   * Filter by updated_at column.
   *
   * @param string $value
   *
   * @return mixed
   */
  public function updatedAt(string $value): Builder {
    $dates = explode(',', $value);

    if (\count($dates) > 1) {
      return $this->builder->whereBetween('updated_at', $dates);
    }

    return $this->builder->whereDate('updated_at', $value);
  }
}
