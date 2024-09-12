<?php

declare(strict_types = 1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

/**
 * The apApp service provider.
 */
class AppServiceProvider extends ServiceProvider {

  /**
   * Register any application services.
   */
  public function register(): void {}

  /**
   * Bootstrap any application services.
   */
  public function boot(): void {
    JsonResource::withoutWrapping();

    RateLimiter::for('public_api', function (Request $request) {
      return $request->user()
        ? Limit::perMinute(60)->by($request->user()->id)
        : Limit::perMinute(30)->by($request->ip());
    });
  }

}
