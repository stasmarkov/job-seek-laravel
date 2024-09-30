<?php

declare(strict_types = 1);

namespace Modules\Employer\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Employer\Models\EmployerProfile;
use Modules\Employer\Policies\EmployerProfilePolicy;

/**
 * The employer modules service provider.
 */
class EmployerServiceProvider extends AuthServiceProvider {

  /**
   * {@inheritdoc}
   */
  protected $policies = [
    EmployerProfile::class => EmployerProfilePolicy::class,
  ];

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
   * Register routes.
   */
  public function registerRoutes() {
    Route::middleware('web')
      ->group(base_path('modules/Employer/routes.php'));
  }

}
