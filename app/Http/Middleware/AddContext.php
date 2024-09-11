<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Symfony\Component\HttpFoundation\Response;

/**
 * Add data into context.
 */
class AddContext {

  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next): Response {
    Context::add([
      'current_user' => Auth::user(),
      'employerProfile' => Auth::user()?->employerProfile ?? NULL,
      'candidateProfile' => Auth::user()?->candidateProfile ?? NULL,
    ]);

    return $next($request);
  }

}
