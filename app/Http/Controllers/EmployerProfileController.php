<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\EmployerProfile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;

/**
 * The Employer Profile Model controller.
 */
class EmployerProfileController extends Controller {

  /**
   * Constructs EmployerController class.
   *
   * @param \Illuminate\Http\Request $request
   *   The request.
   */
  public function __construct(
    protected Request $request
  ) {
  }

  /**
   * {@inheritdoc}
   */
  public static function middleware() {
    return [
      new Middleware('can:create,\App\Model\EmployerProfile', only: [
        'create',
        'store',
      ]),
      new Middleware('can:update,employerProfile', only: ['edit', 'update']),
      new Middleware('can:delete,employerProfile', only: ['destroy']),
    ];
  }

  /**
   * Display a listing of the resource.
   */
  public function index() {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(EmployerProfile $employerProfile) {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(EmployerProfile $employerProfile) {
    //
  }


  /**
   * Show the form for creating a new resource.
   */
  public function edit(EmployerProfile $employerProfile) {
    return Inertia::render('Model/Employer/UpdateForm', [
      'employerProfile' => $employerProfile,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(EmployerProfile $employerProfile) {
    $attributes = $this->request->validate([
      'name' => ['required'],
      'logo' => ['required', File::types(['png', 'webp', 'jpg', 'jpeg'])],
    ]);

    $employerProfile->update([
      'name' => $attributes['name'],
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
