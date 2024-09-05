<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

/**
 * The job controller.
 */
class EmployerController extends Controller implements HasMiddleware {

  /**
   * Constructs EmployerController class.
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
      new Middleware('can:create,\App\Model\Employer', only: ['create', 'store']),
      new Middleware('can:update,employer', only: ['edit', 'update']),
      new Middleware('can:delete,employer', only: ['destroy']),
    ];
  }

  /**
   * Show the form for creating a new resource.
   */
  public function edit(Employer $employer) {
    return Inertia::render('Model/Employer/UpdateForm', [
      'employer' => $employer,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(Employer $employer) {
    $attributes = $this->request->validate([
      'name' => ['required'],
    ]);

    $employer->update($attributes);

    return back();
  }

}
