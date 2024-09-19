<?php

declare(strict_types = 1);

namespace App\Traits;

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
  public function url(): ?string {
    $model = strtolower(Str::snake(class_basename($this)));
    if (Route::has("{$model}.show")) {
      return route("{$model}.show", $this);
    }

    return NULL;
  }

}
