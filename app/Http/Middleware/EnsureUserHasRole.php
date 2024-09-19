<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use App\Enums\UserRolesEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Ensure user has role.
 */
class EnsureUserHasRole {

  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next): Response {
    $user = Auth::user();

    if ($user && !$user?->hasAnyRole([UserRolesEnum::cases()])) {
      // Redirect to the route without current middleware.
      return redirect()->route('profile.role_select');
    }

    return $next($request);
  }

}
