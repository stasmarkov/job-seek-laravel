<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Http\Requests\VacancyCreateRequest;
use App\Http\Requests\VacancyUpdateRequest;
use App\Http\Resources\VacancyResource;
use App\Http\Resources\TagResource;
use App\Models\Vacancy;
use App\Models\Scopes\VacancyScope;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Inertia\Inertia;

/**
 * The vacancy controller.
 */
class VacancyController extends Controller implements HasMiddleware {

  /**
   * {@inheritdoc}
   */
  public static function middleware() {
    return [
      new Middleware('can:viewAny,\App\Model\Vacancy', only: ['index']),
      new Middleware('can:create,\App\Model\Vacancy', only: ['create', 'store']),
      new Middleware('can:update,vacancy', only: ['edit', 'update']),
      new Middleware('can:delete,vacancy', only: ['destroy']),
    ];
  }

  /**
   * Get the list of all vacancies.
   *
   * @return \Inertia\Response
   */
  public function index() {
    $vacancies = Vacancy::query()
      ->currentEmployer()
      ->with(['employerProfile:id,name', 'tags:name,id']);

    $vacancies = $vacancies
      ->paginate(10)
      ->withQueryString();

    return Inertia::render('Model/Vacancy/DashboardList', [
      'vacancies' => $vacancies,
    ]);
  }

  /**
   * The vacancy view page.
   *
   * @param \App\Models\Vacancy $vacancy
   *   The view vacancy.
   *
   * @return \Inertia\Response
   *   The page.
   */
  public function show(Request $request, Vacancy $vacancy) {
    $user = Auth::user();
    $reactantFacade = $vacancy->viaLoveReactant();

    $similar_vacancies = Vacancy::query()
      ->where('id', '!=', $vacancy->id)
      ->latest('created_at')
      ->limit(4);

    $similar_vacancies->where(function (Builder $query) use ($vacancy) {
      foreach ($vacancy->tags as $tag) {
        $query->orWhereRelation('tags', 'tags.id', '=', $tag->id);
      }
    });

    return Inertia::render('Model/Vacancy/View', [
      'vacancy' => VacancyResource::make($vacancy),
      'similarVacancies' => VacancyResource::collection($similar_vacancies->get()),
      'likesCount' => $reactantFacade->getReactionCounterOfType('Like')->getCount(),
      'isLiked' => $reactantFacade->isReactedBy($user, 'Like'),
      'can' => [
        'edit_vacancy' => $user ? $user->can('update', $vacancy) : FALSE,
        'create_vacancy' => Auth::user()?->can('create', Vacancy::class),
      ],
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request) {
    return Inertia::render('Model/Vacancy/CreateForm', [
      'employerProfile' => Context::get('employerProfile'),
      'tags' => TagResource::collection(Tag::all()),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(VacancyCreateRequest $request) {
    // @todo Move to the separate shared storage.
    $attributes = $request->validated();
    $attributes['featured'] = $request->has('featured');

    $vacancy = Auth::user()->employerProfile->vacancies()
      ->create(Arr::except($attributes, 'tags'));

    if (\is_string($attributes['tags'])) {
      $attributes['tags'] = explode(',', $attributes['tags']);
    }
    $vacancy->attachTags($attributes['tags']);

    return redirect(route('vacancy.show', ['vacancy' => $vacancy->id]));
  }

  /**
   * The edit Vacancy Model page.
   *
   * @param \App\Models\Vacancy $vacancy
   *   The Vacancy model.
   *
   * @return \Inertia\Response
   *   The page.
   */
  public function edit(Vacancy $vacancy) {
    return Inertia::render('Model/Vacancy/EditForm', [
      'employerProfile' => Context::get('employerProfile'),
      'vacancy' => VacancyResource::make($vacancy),
      'tags' => TagResource::collection(Tag::all()),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(VacancyUpdateRequest $request, Vacancy $vacancy) {
    $attributes = $request->validated();

    $attributes['featured'] = $request->has('featured');

    if (\is_string($attributes['tags'])) {
      $attributes['tags'] = explode(',', $attributes['tags']);
    }
    $vacancy->attachTags($attributes['tags']);

    unset($attributes['tags']);
    $vacancy->update($attributes);

    return redirect(route('vacancy.show', [
      'vacancy' => $vacancy,
    ]));
  }

  /**
   * React on the like/dislike click.
   */
  public function like(Vacancy $vacancy) {
    $user = Auth::user();
    $reacterFacade = $user?->viaLoveReacter();

    if ($reacterFacade->hasNotReactedTo($vacancy, 'Like')) {
      $reacterFacade->reactTo($vacancy, 'Like');
    }
    else {
      $reacterFacade->unreactTo($vacancy, 'Like');
    }

    return back();
  }

}
