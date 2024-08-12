<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

/**
 *
 */
class RegisteredUserController extends Controller {

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
    return view('auth.register');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    $user_attributes = $request->validate([
      'name' => ['required'],
      'email' => ['required', 'email', 'max:254', 'unique:users,email'],
      'password' => ['required', 'confirmed', Password::min(8)],
    ]);

    $employer_attributes = $request->validate([
      'employer' => ['required', 'unique:employers,name'],
      'logo' => ['required', File::types(['png', 'webp', 'jpg'])],
    ]);

    $user = User::create($user_attributes);

    // Store logos.
    $logo_path = $request->logo->store('logos');
    $user->employer()->create([
      'name' => $employer_attributes['employer'],
      'logo' => $logo_path,
    ]);
    \Auth::login($user);

    return redirect(route('homepage'));
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id) {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id) {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy() {
    //
  }

}
