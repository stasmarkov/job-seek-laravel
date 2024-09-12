<?php

declare(strict_types=1);

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Http\Resources\TagResource;
use App\Models\Job;
use App\Models\Scopes\JobScope;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
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
    $query = Job::query()->with([
      'employerProfile',
      'tags',
    ]);

    $this->applyFilters($request, $query);

    return Inertia::render('Search/Jobs', [
      'filters' => [
        'search' => $request->get('search'),
        'order' => $request->get('order'),
        'tags' => $request->get('tags'),
      ],
      'tags' => TagResource::collection(Tag::all()),
      'results' => JobResource::collection(
        $query
          ->paginate(10)
          ->withQueryString()
      ),
    ]);
  }

  /**
   * Apply filters.
   *
   * @param \Illuminate\Http\Request $request
   *   The income request.
   * @param \Illuminate\Database\Eloquent\Builder $query
   *   The Eloquent model query builder.
   */
  protected function applyFilters(Request $request, Builder $query): void {
    // Sort by created_at date.
    $query->when($request->input('order'), function($sub_query, $order) {
      if (\in_array(strtoupper($order), ['ASC', 'DESC'])) {
        $sub_query->orderBy('created_at', strtoupper($order));
      }
    })
      // Default sorting.
      ->orderBy('created_at', 'DESC');

    // Search by title.
    $query->when($request->input('search'), function($sub_query, $search) {
      $sub_query->where('title', 'LIKE', '%' . $search . '%');
    });

    // Search by tags.
    $query->when($request->input('tags'), function($sub_query, $tags) {
      if (!\is_array($tags)) {
        $tags = [$tags];
      }

      foreach ($tags as $tag) {
        $sub_query->whereRelation('tags', 'tags.id', '=', $tag);
      }
    });
  }

}
