<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * The login log.
 */
class LoginLog extends Model {

  use HasFactory;

  /**
   * {@inheritdoc}
   */
  protected $fillable = [
    'user_id',
    'ip',
  ];

  /**
   * The User Model of the Login Log.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

}
