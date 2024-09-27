<?php

declare(strict_types=1);

namespace Modules\Core\Traits;

/**
 * {@inheritdoc}
 */
trait HasApiResponses {

  /**
   * {@inheritdoc}
   */
  protected function ok($message, array $data = []) {
    return $this->success($message, $data);
  }

  /**
   * {@inheritdoc}
   */
  protected function success(string $message, array $data = [], int $code = 200) {
    return response()->json([
      'data' => $data,
      'message' => $message,
      'success' => TRUE,
      'status' => $code,
    ], $code);
  }

  /**
   * {@inheritdoc}
   */
  protected function error(string $message, int $code) {
    return response()->json([
      'message' => $message,
      'status' => $code,
      'success' => FALSE,
    ], $code);
  }

}
