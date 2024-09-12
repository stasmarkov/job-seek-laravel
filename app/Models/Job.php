<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\UserRolesEnum;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use App\Events\JobCreatedEvent;
use App\Events\JobDeletedEvent;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use App\Traits\TaggableModel;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Job extends Model implements ReactableInterface {

  use HasFactory, Notifiable, Reactable, TaggableModel;



  /**
   * The list of guarded fields.
   *
   * @var string[]
   */
  protected $guarded = [
    'id',
  ];

  /**
   * The list of dispatched events.
   *
   * @var string[]
   */
  protected $dispatchesEvents = [
    'saved' => JobCreatedEvent::class,
    'deleted' => JobDeletedEvent::class,
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
   * Logs only current employer user jobs.
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
