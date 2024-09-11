<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

/**
 * The Candidate Profile model controller.
 */
class CandidateProfileController extends Controller {

  /**
   * Constructs CandidateProfileController class.
   *
   * @param \Illuminate\Http\Request $request
   *   The request.
   */
  public function __construct(
    protected Request $request
  ) {}

  /**
   * {@inheritdoc}
   */
  public static function middleware() {
    return [
      new Middleware('can:create,\App\Model\CandidateProfile', only: [
        'create',
        'store',
      ]),
      new Middleware('can:update,candidateProfile', only: ['edit', 'update']),
      new Middleware('can:delete,candidateProfile', only: ['destroy']),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function edit(User $user) {
    return Inertia::render('Model/Candidate/UpdateForm', [
      'user' => $user,
      'candidateProfile' => $user->candidateProfile,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(User $user) {
    $employerProfile = $user->employerProfile;

    $attributes = $this->request->validate([
      'first_name' => ['required'],
      'last_name' => ['required'],
    ]);

    $employerProfile->update([
      'first_name' => $attributes['first_name'],
      'last_name' => $attributes['last_name'],
    ]);

    if ($this->request->hasFile('logo')) {
      $logo_path = $this->request->file('logo')?->store('public');
      if ($logo_path) {
        $employerProfile->update([
          'logo' => $logo_path,
        ]);
      }
    }

    return back();
  }

}
