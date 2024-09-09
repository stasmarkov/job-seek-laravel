<?php

declare(strict_types = 1);

namespace App\Models;

use App\Models\Scopes\JobScope;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use App\Events\JobCreatedEvent;
use App\Events\JobDeletedEvent;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
#[ScopedBy(JobScope::class)]
class Job extends Model implements ReactableInterface {

  use HasFactory, Notifiable, Reactable;

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
   * Get the Employer data model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   *   The Employer model.
   */
  public function employer(): BelongsTo {
    return $this->belongsTo(Employer::class);
  }

  /**
   * Set the Jobs' model Tag model.
   *
   * @param string $name
   *   The Tag name.
   */
  public function tag(string $name): void {
    // Find first tag with given name or create a new one.
    $tag = Tag::firstOrCreate(['name' => trim($name)]);
    $this->tags()->attach($tag);
  }

  /**
   * Get the list of Tag models.
   */
  public function tags(): BelongsToMany {
    return $this->belongsToMany(Tag::class)->withTimestamps();
  }

}
