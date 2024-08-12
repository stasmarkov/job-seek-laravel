<?php

namespace App\Models;

use App\Traits\LikableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * The BlogPost model.
 */
class BlogPost extends Model {

  use HasFactory, LikableModel;

  /**
   * Get the User model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   *   The User model.
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

}
