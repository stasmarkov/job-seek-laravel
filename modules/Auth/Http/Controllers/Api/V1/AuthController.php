<?php

declare(strict_types=1);

namespace Modules\Auth\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Requests\Api\V1\LoginRequest;
use Modules\Auth\Models\User;
use Modules\Core\Traits\HasApiResponses;

/**
 * {@inheritdoc}
 */
class AuthController extends Controller {

  use HasApiResponses;

  /**
   * {@inheritdoc}
   */
  public function login(LoginRequest $request) {
    $request->validated($request->all());

    if (!Auth::attempt($request->only('email', 'password'))) {
      return $this->error('Invalid credentials', 401);
    }

    $user = User::query()->firstWhere('email', $request->email);

    if (!$user) {
      return $this->error('User not found', 404);
    }

    return $this->ok('Authenticated', [
      'token' => $user->createToken(
        'API Token for ' . $user->email,
        ['*'],
        now()->addDay()
      )->plainTextToken,
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function logout(Request $request) {
    $request->user()->currentAccessToken()->delete();
    return $this->ok('Unauthorized user from the system');
  }

}
