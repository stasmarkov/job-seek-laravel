<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Vacancy\Http\Resources\VacancyResource;
use Modules\Vacancy\Models\Scopes\VacancyScope;
use Modules\Vacancy\Models\Vacancy;

/**
 * The homepage controller class.
 */
class HomepageController extends Controller {

  /**
   * The homepage controller.
   *
   * @return mixed
   *   The Inertia render page.
   */
  public function index() {
    $vacancies_featured = Cache::remember('views:vacancies:homepage:featured', 3600, static function () {
      return Vacancy::latest()
        ->withoutGlobalScope(VacancyScope::class)
        ->where('featured', TRUE)
        ->limit(6)
        ->get();
    });

    $vacancies = Cache::remember('views:vacancies:homepage:non-featured', 3600, static function () {
      return Vacancy::latest()
        ->withoutGlobalScope(VacancyScope::class)
        ->where('featured', FALSE)
        ->limit(9)
        ->get();
    });

    $tags = Cache::remember('tags:all', 3600, static function () {
      return Tag::all();
    });

    return Inertia::render('Homepage', [
      'canLogin' => Route::has('login'),
      'canRegister' => Route::has('register'),
      'laravelVersion' => Application::VERSION,
      'phpVersion' => PHP_VERSION,
      'featuredVacancies' => VacancyResource::collection($vacancies_featured),
      'vacancies' => VacancyResource::collection($vacancies),
      'tags' => TagResource::collection($tags),
    ]);
  }

}
