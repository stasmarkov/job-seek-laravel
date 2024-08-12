<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * The user controller.
 */
class SessionController extends Controller {

  /**
   * Creates the UserController class.
   *
   * @param \Illuminate\Http\Request $request
   *   The income request.
   */
  public function __construct(
    protected Request $request
  ) {
  }

  /**
   * {@inheritdoc}
   */
  public function create() {
    return view('auth.login');
  }

  /**
   * {@inheritdoc}
   */
  public function store() {
    // Validate password.
    $validated_attributes = $this->request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    // Try to login user.
    if (!\Auth::attempt($validated_attributes)) {
      throw ValidationException::withMessages([
        'email' => 'Sorry, email or password is wrong or user has not been found.',
      ]);
    }

    // Regenerate the session.
    $this->request->session()->regenerate();

    // Redirect user.
    return redirect()->route('homepage');
  }

  /**
   * {@inheritdoc}
   */
  public function destroy() {
    \Auth::logout();
    return redirect()->route('homepage');
  }

}
