<?php

declare(strict_types = 1);

namespace Modules\Candidate\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Route;
use Modules\Candidate\Models\CandidateProfile;
use Modules\Candidate\Policies\CandidateProfilePolicy;

/**
 * The candidate modules service provider.
 */
class CandidateServiceProvider extends AuthServiceProvider {

  /**
   * {@inheritdoc}
   */
  protected $policies = [
    CandidateProfile::class => CandidateProfilePolicy::class,
  ];

  /**
   * Bootstrap services.
   */
  public function boot(): void {
    $this->registerRoutes();
    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
  }

  /**
   * Register routes.
   */
  public function registerRoutes() {
    Route::middleware('web')
      ->group(base_path('modules/Candidate/routes.php'));
  }

}
