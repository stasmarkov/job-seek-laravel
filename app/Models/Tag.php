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
   * Get the list of Vacancy models.
   */
  public function vacancies(): BelongsToMany {
    return $this->belongsToMany(Vacancy::class)->withTimestamps();
  }

}
