<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\UserRolesEnum;
use App\Traits\HasUuid;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use App\Events\VacancyCreatedEvent;
use App\Events\VacancyDeletedEvent;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasTags;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Vacancy extends Model implements ReactableInterface {

  use HasFactory, Notifiable, Reactable, HasTags, HasUuid;

  /**
   * {@inheritdoc}
   */
  protected $guarded = [
    'id',
  ];

  /**
   * {@inheritdoc}
   */
  protected $with = [
    'tags',
    'employerProfile',
  ];

  /**
   * The list of dispatched events.
   *
   * @var string[]
   */
  protected $dispatchesEvents = [
    'saved' => VacancyCreatedEvent::class,
    'deleted' => VacancyDeletedEvent::class,
  ];

  /**
   * Get the Employer Profile model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   *   The Employer Profile Model.
   */
  public function employerProfile(): BelongsTo {
    return $this->belongsTo(EmployerProfile::class);
  }

  /**
   * Logs only current employer user vacancies.
   *
   * @param \Illuminate\Database\Eloquent\Builder $builder
   *   The builder.
   */
  public function scopeCurrentEmployer(Builder $builder): void {
    $user = Auth::user();

    if ($user && $user->hasRole(UserRolesEnum::EMPLOYER->value)) {
      $builder->whereRelation('employerProfile', 'user_id', '=', $user->id);
    }
  }

}
