<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Role;

/**
 * The role select page controller.
 */
class RoleSelectController extends Controller {

  /**
   * The edit page.
   */
  public function edit() {
    return Inertia::render('Admin/RoleSelect');
  }

  /**
   * The edit page callback.
   */
  public function update(Request $request) {
    $role = $request->get('role');

    try {
      $role = Role::findByName($role);
      Auth::user()?->assignRole($role->name);
    }
    catch (RoleDoesNotExist $e) {
      abort(403);
    }

    return redirect()->route('dashboard');
  }

}
