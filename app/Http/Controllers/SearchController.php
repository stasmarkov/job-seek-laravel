<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

/**
 * The search controller.
 */
class SearchController extends Controller {

  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request) {
    if ($request->get('q') === '_all') {
      $results = Job::with([
        'employer',
        'tags',
      ])->get();
    }
    else {
      $results = Job::with([
        'employer',
        'tags',
      ])->where('title', 'LIKE', '%' . $request->get('q') . '%')->get();
    }

    return view('search.job_results', [
      'results' => $results,
    ]);
  }

}
