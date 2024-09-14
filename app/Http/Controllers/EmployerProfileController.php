<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\EmployerProfileRequest;
use App\Http\Resources\EmployerProfileResource;
use App\Http\Resources\VacancyResource;
use App\Models\EmployerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

/**
 * The Employer Profile Model controller.
 */
class EmployerProfileController extends Controller {

  /**
   * Constructs EmployerProfileController class.
   *
   * @param \Illuminate\Http\Request $request
   *   The request.
   */
  public function __construct(
    protected Request $request
  ) {
    $this->middleware('can:create,\App\Model\EmployerProfile')->only('create', 'store');
    $this->middleware('can:update,\App\Model\EmployerProfile')->only('edit', 'update');
    $this->middleware('can:delete,\App\Model\EmployerProfile')->only('destroy');
  }

  /**
   * Display a listing of the resource.
   */
  public function index() {}

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
    return 'TBD.';
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {}

  /**
   * Display the specified resource.
   */
  public function show(EmployerProfile $employerProfile) {
    $vacancies = $employerProfile->vacancies()->paginate(10);

    return Inertia::render('Model/EmployerProfile/View', [
      'employerProfile' => EmployerProfileResource::make($employerProfile),
      'vacancies' => VacancyResource::collection($vacancies),
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(EmployerProfile $employerProfile) {}

  /**
   * Show the form for creating a new resource.
   */
  public function edit(User $user) {
    return ';hello';
    return Inertia::render('Model/EmployerProfile/UpdateForm', [
      'user' => $user,
      'employerProfile' => $user->employerProfile,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(EmployerProfileRequest $request, User $user) {
    $employerProfile = $user->employerProfile;

    $attributes = $request->validated();

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
