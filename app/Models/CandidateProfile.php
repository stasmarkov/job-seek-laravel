<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * The candidate profile model.
 */
class CandidateProfile extends Model {

  use HasFactory;

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function contactInformation(): HasOne {
    return $this->hasOne(ContactInformation::class);
  }

}
