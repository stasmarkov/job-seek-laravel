<?php

namespace App\Http\Middleware;

use App\Enums\UserRolesEnum;
use App\Http\Resources\UserResource;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware {

  /**
   * The root template that is loaded on the first page visit.
   *
   * @var string
   */
  protected $rootView = 'app';

  /**
   * Determine the current asset version.
   */
  public function version(Request $request): string|null {
    return parent::version($request);
  }

  /**
   * Define the props that are shared by default.
   *
   * @return array<string, mixed>
   */
  public function share(Request $request): array {
    return [
      ...parent::share($request),
      'auth' => [
        'user' => $request->user(),
      ],
      'ziggy' => fn() => [
        ...(new Ziggy)->toArray(),
        'location' => $request->url(),
      ],
      'can' => [
        'create_vacancy' => Auth::user()?->can('create', Vacancy::class),
      ],
      'isAdmin' => Auth::user() ? Auth::user()?->hasRole(UserRolesEnum::ADMIN->value) : FALSE,
      'isEmployer' => Auth::user() ? Auth::user()?->hasRole(UserRolesEnum::EMPLOYER->value) : FALSE,
      'isCandidate' => Auth::user() ? Auth::user()?->hasRole(UserRolesEnum::CANDIDATE->value) : FALSE,
    ];
  }

}
