<?php

declare(strict_types = 1);

namespace Modules\Auth\Models;

use App\Http\Filters\V1\QueryFilter;
use App\Models\BlogPost;
use App\Models\LoginLog;
use App\Traits\HasSiteRoles;
use App\Traits\HasUrl;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableInterface;
use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\Database\Factories\UserFactory;
use Modules\Candidate\Models\CandidateProfile;
use Modules\Employer\Models\EmployerProfile;
use Spatie\Permission\Traits\HasRoles;

/**
 * The user model.
 */
class User extends Authenticatable implements ReacterableInterface {

  use HasFactory;
  use Notifiable;
  use HasRoles;
  use HasApiTokens;
  use Reacterable;
  use HasSiteRoles;
  use HasUrl;

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
    'github_id',
    'github_token',
    'github_refresh_token',
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
   * {@inheritdoc}
   */
  protected static function newFactory(): UserFactory {
    return UserFactory::new();
  }

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
   * Get the Employer Profile Model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   *   The Employer Profile Model.
   */
  public function employerProfile(): HasOne {
    return $this->hasOne(EmployerProfile::class, 'user_id', 'id');
  }

  /**
   * Get the Candidate Profile Model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   *   The Candidate Profile Model.
   */
  public function candidateProfile(): HasOne {
    return $this->hasOne(CandidateProfile::class, 'user_id', 'id');
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

  /**
   * Add filters for JSON:API.
   */
  public function scopeFilter(Builder $builder, QueryFilter $filter) {
    return $filter->apply($builder);
  }

}
