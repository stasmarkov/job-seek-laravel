<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;


/**
 * The search controller.
 */
class SearchJobsController extends Controller {

  /**
   * Handle the incoming request.
   */
  public function index() {
    return Inertia::render('Search/SearchJobs');
  }

  /**
   * Handle the incoming request.
   */
  public function doSearch() {
    return Inertia::render('Search/SearchJobs');
  }

  /**
   * Handle the results incoming request.
   */
  public function results(Request $request) {
    $b=0;

    $results = Job::with([
      'employer',
      'tags',
    ]);

    if ($request->exists('q') && $request->get('q') !== '_all') {
      $results->where('title', 'LIKE', '%' . $request->get('q') . '%');
    }

    return $results->paginate(6);
  }

}
