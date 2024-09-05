<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRolesEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

/**
 * The registration controller.
 */
class RegisteredUserController extends Controller {

  /**
   * Display the registration view.
   */
  public function create(): Response {
    $roles = Role::whereIn('name', [
      UserRolesEnum::EMPLOYER->value,
      UserRolesEnum::EMPLOYEE->value,
    ])
      ->get()
      ->pluck('name', 'id')
      ->map(function ($role) {
        return UserRolesEnum::from($role)->label();
      });

    return Inertia::render('Auth/Register', [
      'roles' => $roles,
    ]);
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'role' => 'in:2,3',
    ]);

    $role = Role::findOrFail($request->role);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);
    $user->roles()->attach($role);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: FALSE));
  }

}
