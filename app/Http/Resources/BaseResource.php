<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

/**
 * The base resource class.
 */
abstract class BaseResource extends JsonResource {

  /**
   * Returns only specified keys.
   *
   * @param ...$attributes
   *   The list of keys.
   *
   * @return array
   *   The list of resource properties.
   */
  public function only(...$attributes): array {
    return Arr::only($this->resolve(), $attributes);
  }

}
