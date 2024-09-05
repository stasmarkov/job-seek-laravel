<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
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
  public function profile() {
    return $this->hasOne(Profile::class);
  }

}
