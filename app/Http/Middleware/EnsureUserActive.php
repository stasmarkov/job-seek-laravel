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
class EnsureUserActive {

  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next): Response {
    $user = Auth::user();

    if ($user && $user->status === 0) {
      // Redirect to the route without current middleware.
      return redirect()->route('verification.notice');
    }

    return $next($request);
  }

}
