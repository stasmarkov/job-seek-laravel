<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Auth;

/**
 * Provides Model trait for likable Models.
 */
trait LikableModel {

  /**
   * {@inheritdoc}
   */
  public function like(?User $user = NULL) {
    $user = $user ?: Auth::user();
    try {
      $this->likes()->attach($user);
    }
    catch (UniqueConstraintViolationException) { }
  }

  /**
   * {@inheritdoc}
   */
  public function likes() {
    return $this->morphToMany(User::class, 'likable')->withTimestamps();
  }

}
