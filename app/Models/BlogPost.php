<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\Core\Traits\HasLikes;

/**
 * The BlogPost model.
 */
class BlogPost extends Model {

  use HasFactory, HasLikes;

  /**
   * Get the User model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   *   The User model.
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class, 'user_id');
  }

}
