<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * THe contact information model.
 */
class ContactInformation extends Model {

  use HasFactory;

  /**
   * Get the candidate profile query builder.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   *   The candidate profile query builder.
   */
  public function candidateProfile(): BelongsTo {
    return $this->belongsTo(CandidateProfile::class);
  }

}
