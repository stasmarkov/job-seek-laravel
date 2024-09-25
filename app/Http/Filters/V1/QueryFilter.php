<?php

declare(strict_types=1);

namespace App\Http\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class QueryFilter {

  /**
   * {@inheritdoc}
   */
  protected Builder $builder;

  /**
   * List f columns be which sorting could be performed.
   *
   * @var array
   */
  protected array $sortable = [];

  /**
   * {@inheritdoc}
   */
  public function __construct(protected Request $request) {}

  /**
   * Apply filters.
   *
   * @param \Illuminate\Database\Eloquent\Builder $builder
   *   The eloquent query builder.
   *
   * @return \Illuminate\Database\Eloquent\Builder
   *   The eloquent query builder.
   */
  public function apply(Builder $builder) {
    $this->builder = $builder;

    if ($this->request->has('filter')) {
      $this->filter($this->request->get('filter'));
    }

    if ($this->request->has('include')) {
      $this->include($this->request->get('include'));
    }

    if ($this->request->has('sort')) {
      $this->sort($this->request->get('sort'));
    }

    return $this->builder;
  }

  /**
   * Apply the filter for the builder.
   *
   * @param array $filters
   *   The array of filters.
   *
   * @return \Illuminate\Database\Eloquent\Builder
   *   The eloquent model query builder.
   */
  protected function filter(array $filters = []) {
    foreach ($filters as $key => $value) {
      if (method_exists($this, $key)) {
        $this->$key($value);
      }
    }

    return $this->builder;
  }

  /**
   * Includes related models resources.
   *
   * @param array $includes
   *   The list of included eloquent models.
   *
   * @return \Illuminate\Database\Eloquent\Builder
   *   The eloquent model query builder.
   */
  protected function include(array $includes = []) {
    foreach ($includes as $value) {
      $method = 'include' . ucfirst($value);
      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }

    return $this->builder;
  }

  /**
   * Apply the sort for the builder.
   *
   * @param array $sort
   *   The array of sorts.
   *
   * @return \Illuminate\Database\Eloquent\Builder
   *   The eloquent model query builder.
   */
  protected function sort(array $sort = []) {
    foreach ($sort as $column => $direction) {
      if (!\in_array($column, $this->sortable, TRUE)) {
        continue;
      }

      if (empty($direction) || !\in_array(strtoupper($direction), ['ASC', 'DESC'], TRUE)) {
        $direction = 'ASC';
      }

      $column = Str::snake($column);
      $this->builder->orderBy($column, $direction);
    }

    return $this->builder;
  }

}
