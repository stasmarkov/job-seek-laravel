<?php

declare(strict_types = 1);

namespace Modules\Employer\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Employer\Models\EmployerProfile;
use Modules\Employer\Policies\EmployerProfilePolicy;

/**
 * The employer modules service provider.
 */
class EmployerServiceProvider extends ServiceProvider {

  /**
   * Bootstrap services.
   */
  public function boot(): void {
    // Load migrations from module.
    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    $this->registerPolicies();
  }

  /**
   * {@inheritdoc}
   */
  public function registerPolicies() {
    Gate::policy(EmployerProfile::class, EmployerProfilePolicy::class);
  }

}
