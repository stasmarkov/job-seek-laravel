<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Models;

use App\Enums\UserRolesEnum;
use App\Traits\HasTags;
use App\Traits\HasUrl;
use App\Traits\HasUuid;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Http\Filters\V1\QueryFilter;
use Modules\Employer\Models\EmployerProfile;
use Modules\Vacancy\Database\Factories\VacancyFactory;
use Modules\Vacancy\Events\VacancyCreatedEvent;
use Modules\Vacancy\Events\VacancyDeletedEvent;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Vacancy extends Model implements ReactableInterface {

  use HasFactory;
  use Notifiable;
  use Reactable;
  use HasTags;
  use HasUuid;
  use HasUrl;

  /**
   * {@inheritdoc}
   */
  protected static function newFactory(): VacancyFactory {
    return VacancyFactory::new();
  }

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

  /**
   * Add filters for JSON:API.
   */
  public function scopeFilter(Builder $builder, QueryFilter $filter) {
    return $filter->apply($builder);
  }

}
