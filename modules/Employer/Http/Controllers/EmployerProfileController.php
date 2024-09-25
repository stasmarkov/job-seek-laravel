<?php

declare(strict_types = 1);

namespace Modules\Employer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Modules\Auth\Models\User;
use Modules\Employer\Http\Requests\EmployerProfileRequest;
use Modules\Employer\Http\Resources\EmployerProfileResource;
use Modules\Employer\Models\EmployerProfile;
use Modules\Vacancy\Http\Resources\VacancyResource;

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
  ) {}

  /**
   * Display a listing of the resource.
   */
  public function index() {}

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
   * Show the form for creating a new resource.
   */
  public function create(User $user) {
    if ($user->employerProfile) {
      return redirect()->route('profile.employer.edit', ['user' => $user->id]);
    }

    $this->authorize('create', EmployerProfile::class);

    return 'TBD.';
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, User $user) {
    $this->authorize('create', EmployerProfile::class);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function edit(User $user) {
    if (!$user->employerProfile) {
      return redirect()->route('profile.employer.create', ['user' => $user->id]);
    }

    $this->authorize('update', $user->employerProfile);

    return Inertia::render('Model/EmployerProfile/UpdateForm', [
      'user' => $user,
      'employerProfile' => $user->employerProfile,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(EmployerProfileRequest $request, User $user) {
    $this->authorize('update', $user->employerProfile);

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

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user) {
    $this->authorize('delete', $user->employerProfile);
  }

}
