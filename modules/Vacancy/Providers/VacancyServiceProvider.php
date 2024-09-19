<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Candidate\Models\CandidateProfile;
use Modules\Candidate\Policies\CandidateProfilePolicy;
use Modules\Employer\Models\EmployerProfile;
use Modules\Employer\Policies\EmployerProfilePolicy;
use Modules\Vacancy\Events\VacancyCreatedEvent;
use Modules\Vacancy\Events\VacancyDeletedEvent;
use Modules\Vacancy\Events\VacancyViewedEvent;
use Modules\Vacancy\Listeners\VacancyCreatedSubscriber;
use Modules\Vacancy\Listeners\VacancyDeletedSubscriber;
use Modules\Vacancy\Listeners\VacancyViewedSubscriber;

/**
 * The vacancy modules service provider.
 */
class VacancyServiceProvider extends ServiceProvider {

  /**
   * Bootstrap services.
   */
  public function boot(): void {
    $this->registerEventSubscribers();
    $this->registerPolicies();

    // Load migrations from module.
    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    // Load module configs.
    $this->mergeConfigFrom(__DIR__ . '/../config.php', 'vacancy');
  }

  /**
   * {@inheritdoc}
   */
  public function registerPolicies() {
    Gate::policy(CandidateProfile::class, CandidateProfilePolicy::class);
  }

  /**
   * {@inheritdoc}
   */
  public function registerEventSubscribers(): void {
    Event::subscribe(VacancyCreatedSubscriber::class);
    Event::subscribe(VacancyDeletedSubscriber::class);
    Event::subscribe(VacancyViewedSubscriber::class);
  }

}
