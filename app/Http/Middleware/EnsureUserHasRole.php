<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

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
    if (($user = Auth::user()) && $user->roles()->count() === 0) {
      return redirect()->route('profile.role_select');
    }

    return $next($request);
  }

}
