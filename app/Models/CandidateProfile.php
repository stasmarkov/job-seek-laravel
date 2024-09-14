<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Traits\HasTags;

/**
 * The candidate profile model.
 */
class CandidateProfile extends Model {

  use HasFactory, HasTags;

  /**
   * {@inheritdoc}
   */
  protected $fillable = [
    'first_name',
    'last_name',
    'description',
    'achievements',
    'experience_since',
  ];

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
