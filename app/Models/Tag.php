<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * The Tag model.
 */
class Tag extends Model {

  /**
   * The list of guarded fields.
   *
   * @var string[]
   */
  protected $guarded = [
    'id',
  ];

  use HasFactory;

  /**
   * {@inheritdoc}
   */
  protected $fillable = [
    'name',
  ];

  /**
   * Get the list of Job models.
   */
  public function jobs(): BelongsToMany {
    return $this->belongsToMany(Job::class)->withTimestamps();
  }

}
