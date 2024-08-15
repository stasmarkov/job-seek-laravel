<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller {

  /**
   * {@inheritdoc}
   */
  public function __invoke(Tag $tag) {
    return view('search.job_results', [
      'results' => $tag->jobs()->paginate(10),
    ]);
  }

}
