<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\AccountUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

/**
 * The profile controller.
 */
class AccountController extends Controller {

  /**
   * Display the user's profile form.
   */
  public function edit(Request $request, User $user): Response {
    return Inertia::render('Admin/Account/Edit', [
      'user' => UserResource::make($user),
      'mustVerifyEmail' => $user instanceof MustVerifyEmail,
      'status' => session('status'),
      'employerProfile' => Context::get('employerProfile'),
      'candidateProfile' => Context::get('candidateProfile'),
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(User $user, AccountUpdateRequest $request): RedirectResponse {
    $user->fill($request->validated());

    $request->validate([
      'name' => ['min:3'],
    ]);

    if ($user->isDirty('email')) {
      $user->email_verified_at = NULL;
    }

    $user->save();

    return redirect()->route('dashboard');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse {
    $request->validate([
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }

}
