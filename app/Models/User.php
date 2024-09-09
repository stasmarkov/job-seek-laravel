<?php

declare(strict_types = 1);

namespace App\Models;

use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * The user model.
 */
class User extends Authenticatable implements ReacterableInterface {

  use HasFactory, Notifiable, HasRoles, HasApiTokens, Reacterable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'avatar',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * Get the Employer data model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   *   The Employer Model.
   */
  public function employer(): HasOne {
    return $this->hasOne(Employer::class);
  }

  /**
   * Get User model BlogPost models.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   *   The list of User model BlogPost models.
   */
  public function blogPosts(): HasMany {
    return $this->hasMany(BlogPost::class);
  }

  /**
   * Get the Profile Model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   *   Returns the Profile Model.
   */
  public function profile(): HasOne {
    return $this->hasOne(Profile::class);
  }

  /**
   * Local scope to retrieve only active users.
   *
   * @param \Illuminate\Database\Eloquent\Builder $query
   *   The query builder.
   */
  public function scopeActive(Builder $query) {
    $query->where('status', '=', 1);
  }

  /**
   * Returns the collection of user Login Logs models.
   */
  public function loginLogs(): HasMany {
    return $this->hasMany(LoginLog::class);
  }

  /**
   * {@inheritdoc}
   */
  protected static function boot() {
    parent::boot();

    static::saving(function (User $user) {
      $user->avatar = 'https://api.dicebear.com/9.x/pixel-art/svg?seed=' . $user->name;
    });
  }

}
