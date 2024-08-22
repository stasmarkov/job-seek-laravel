<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employer extends Model {

  protected $fillable = [
    'user_id',
    'name',
    'logo',
  ];

  use HasFactory;

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
   * Get the list of Job data models.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   *   The list of Job models.
   */
  public function jobs(): HasMany {
    return $this->hasMany(Job::class);
  }

}
