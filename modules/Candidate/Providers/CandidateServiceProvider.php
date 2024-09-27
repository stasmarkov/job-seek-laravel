<?php

declare(strict_types = 1);

namespace Modules\Candidate\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Candidate\Models\CandidateProfile;
use Modules\Candidate\Policies\CandidateProfilePolicy;

/**
 * The candidate modules service provider.
 */
class CandidateServiceProvider extends ServiceProvider {

  /**
   * Bootstrap services.
   */
  public function boot(): void {
    $this->registerPolicies();
    $this->registerRoutes();

    // Load migrations from module.
    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
  }

  /**
   * {@inheritdoc}
   */
  public function registerPolicies() {
    Gate::policy(CandidateProfile::class, CandidateProfilePolicy::class);
  }

  /**
   * Register routes.
   */
  public function registerRoutes() {
    Route::middleware('web')
      ->group(base_path('modules/Candidate/routes.php'));
  }

}
