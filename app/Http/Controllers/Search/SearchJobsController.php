<?php

declare(strict_types=1);

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * The search controller.
 */
class SearchJobsController extends Controller {

  /**
   * Handle the incoming request [GET].
   */
  public function index(Request $request) {
    return Inertia::render('Search/SearchJobs', [
      'filters' => $request->only(['search', 'order', 'tags']),
      'tags' => Tag::all(),
      'results' => Job::query()
        ->with([
          'employer',
          'tags',
        ])
        // Sort by created_at date.
        ->when($request->input('order'), function ($query, $order) {
          if (\in_array(strtoupper($order), ['ASC', 'DESC'])) {
            $query->orderBy('created_at', strtoupper($order));
          }
        })
        ->orderBy('created_at', 'DESC')
        // Search by title.
        ->when($request->input('search'), function ($query, $search) {
          $query->where('title', 'LIKE', '%' . $search . '%');
        })
        // Search by title.
        ->when($request->input('tags'), function ($sub_query, $tags) {
          if (!\is_array($tags)) {
            $tags = [$tags];
          }

          foreach ($tags as $tag) {
            $sub_query->whereRelation('tags', 'tags.id', '=', $tag);
          }
        })
        ->paginate(6)
        // Important to pre-save the query in pager links.
        ->withQueryString(),
    ]);
  }

}
