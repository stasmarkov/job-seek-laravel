<?php

declare(strict_types=1);

use App\Http\Middleware\EnsureUserActive;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Tighten\Ziggy\Ziggy;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    api: __DIR__ . '/../routes/api.php',
    commands: __DIR__ . '/../routes/console.php',
    channels: __DIR__ . '/../routes/channels.php',
    health: '/up',
  )
  ->withMiddleware(function(Middleware $middleware) {
    $middleware->web(append: [
      HandleInertiaRequests::class,
      AddLinkHeadersForPreloadedAssets::class,
      EnsureUserHasRole::class,
    ])
      ->alias([
        'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        'user_has_role' => EnsureUserHasRole::class,
        'user_active' => EnsureUserActive::class,
      ]);
  })
  ->withExceptions(function(Exceptions $exceptions) {
    $exceptions->respond(function(Response $response, Throwable $exception, Request $request) {
      if (in_array($response->getStatusCode(), [500, 503, 404, 403])) {
        return Inertia::render('Error/Page', [
          'status' => $response->getStatusCode(),
          'auth' => [
            'user' => $request->user(),
          ],
          'ziggy' => fn() => [
            ...(new Ziggy)->toArray(),
            'location' => $request->url(),
          ],
        ])
          ->toResponse($request)
          ->setStatusCode($response->getStatusCode());
      }

      if ($response->getStatusCode() === 419) {
        return back()->with([
          'message' => 'The page expired, please try again.',
        ]);
      }

      return $response;
    });
  }
  )->create();
