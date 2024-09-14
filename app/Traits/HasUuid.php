<?php

declare(strict_types=1);

namespace App\Traits;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait HasUuid {

  /**
   *
   * Get the uuid value.
   *
   * @return \Ramsey\Uuid\UuidInterface
   *   The uuid.
   */
  public function uuid(): UuidInterface {
    return Uuid::fromString($this->uuid);
  }

  /**
   * Find model by uuid.
   *
   * @param \Ramsey\Uuid\UuidInterface $uuid
   *   The uuid.
   *
   * @return \App\Traits\HasUuid
   *   The model.
   */
  public static function findByUuidOrFail(UuidInterface $uuid): self {
    return static::where('uuid', $uuid->toString())->firstOrFail();
  }

}
