<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Candidate\Database\Factories\ContactInformationFactory;
use Modules\Candidate\Models\CandidateProfile;

/**
 * THe contact information model.
 */
class ContactInformation extends Model {

  use HasFactory;

  /**
   * {@inheritdoc}
   */
  protected static function newFactory(): ContactInformationFactory {
    return new ContactInformationFactory();
  }

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
