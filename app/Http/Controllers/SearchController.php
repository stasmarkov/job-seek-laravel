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
      ])->paginate(10);
    }
    else {
      $results = Job::with([
        'employer',
        'tags',
      ])->where('title', 'LIKE', '%' . $request->get('q') . '%')->paginate(10);
    }

    return view('search.job_results', [
      'results' => $results,
    ]);
  }

}
