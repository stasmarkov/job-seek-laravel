<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * The base controller.
 */
abstract class ApiController extends BaseController {
  use AuthorizesRequests;
  use DispatchesJobs;
  use ValidatesRequests;

  /**
   * {@inheritdoc}
   */
  public function include(string $relationship): bool {
    $params = request()->get('include');

    if (!isset($params)) {
      return FALSE;
    }

    $include_values = explode(',', strtolower($params));

    return \in_array(strtolower($relationship), $include_values, TRUE);
  }

}
