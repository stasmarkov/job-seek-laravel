<?php

declare(strict_types = 1);

namespace Modules\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * The candidate modules service provider.
 */
class AuthServiceProvider extends ServiceProvider {

  /**
   * Bootstrap services.
   */
  public function boot(): void {
    $this->registerRoutes();

    // Load migrations from module.
    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
  }

  /**
   * Register routes.
   */
  public function registerRoutes() {
    Route::middleware('api')
      ->prefix('api/v1')
      ->group(base_path('modules/Auth/api.v1.php'));

    Route::middleware('web')
      ->group(base_path('modules/Auth/routes.php'));
  }

}
