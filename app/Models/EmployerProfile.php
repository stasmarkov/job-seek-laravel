<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * The employer profile model.
 */
class EmployerProfile extends Model {

  use HasFactory;

  /**
   * {@inheritdoc}
   */
  protected $guarded = [
    'user_id',
  ];

  /**
   * Get the User data model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   *   The User model.
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the list of Vacancies data models.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   *   The list of Vacancies models.
   */
  public function vacancies(): HasMany {
    return $this->hasMany(Vacancy::class);
  }

}
