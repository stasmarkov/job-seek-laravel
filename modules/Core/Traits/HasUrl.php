<?php

declare(strict_types = 1);

namespace Modules\Core\Traits;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 * The ability to tag models.
 */
trait HasUrl {

  /**
   * Get the URL of the show model page.
   *
   * The route should match the next pattern "[model_name].show".
   *
   * @return string|null
   *   The URL to the show model page or NULL.
   */
  public function toUrl(string $prefix = ''): ?string {
    $model = strtolower(Str::snake(class_basename($this)));
    if (Route::has("{$prefix}{$model}.show")) {
      return route("{$prefix}{$model}.show", $this);
    }

    return NULL;
  }

}
