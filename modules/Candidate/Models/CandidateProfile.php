<?php

declare(strict_types=1);

namespace Modules\Candidate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Auth\Models\User;
use Modules\Candidate\Database\Factories\CandidateProfileFactory;
use Modules\Core\Traits\HasTags;

/**
 * The candidate profile model.
 */
class CandidateProfile extends Model {

  use HasFactory, HasTags;

  /**
   * {@inheritdoc}
   */
  protected static function newFactory(): CandidateProfileFactory {
    return CandidateProfileFactory::new();
  }

  /**
   * {@inheritdoc}
   */
  protected $fillable = [
    'user_id',
    'first_name',
    'last_name',
    'description',
    'achievements',
    'experience_since',
  ];

  /**
   * {@inheritdoc}
   */
  protected $with = [
    'tags',
    'contactInformation',
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
