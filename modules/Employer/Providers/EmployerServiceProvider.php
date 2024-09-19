<?php

declare(strict_types = 1);

namespace Modules\Employer\Providers;

use Illuminate\Support\ServiceProvider;

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
  }

}
