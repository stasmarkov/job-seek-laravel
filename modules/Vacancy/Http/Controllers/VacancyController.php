<?php

declare(strict_types=1);

namespace Modules\Vacancy\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Modules\Vacancy\Http\Requests\VacancyCreateRequest;
use Modules\Vacancy\Http\Requests\VacancyUpdateRequest;
use Modules\Vacancy\Http\Resources\VacancyResource;
use Modules\Vacancy\Jobs\CreateCandidate;
use Modules\Vacancy\Jobs\CreateVacancy;
use Modules\Vacancy\Jobs\UpdateCandidate;
use Modules\Vacancy\Jobs\UpdateVacancy;
use Modules\Vacancy\Models\Vacancy;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The vacancy controller.
 */
class VacancyController extends Controller {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->middleware('can:viewAny,\Modules\Vacancy\Models\Vacancy')
      ->only('index');
    $this->middleware('can:update,vacancy')->only('edit', 'update');
    $this->middleware('can:delete,vacancy')->only('destroy');
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
      'vacancies' => VacancyResource::collection($vacancies),
    ]);
  }

  /**
   * The vacancy view page.
   *
   * @param \Modules\Vacancy\Models\Vacancy $vacancy
   *   The view vacancy.
   *
   * @return \Inertia\Response
   *   The page.
   */
  public function show(Request $request, Vacancy $vacancy) {
    $user = Auth::user();
    $reactantFacade = $vacancy->viaLoveReactant();

    $similar_vacancies_query = Vacancy::query()
      ->where('id', '!=', $vacancy->id)
      ->whereHas('employerProfile', function (Builder $query) use ($vacancy) {
        $query->where('id', $vacancy->employerProfile()->pluck('id'));
      })
      ->whereHas('tags', function (Builder $query) use ($vacancy) {
        $query->whereIn('tags.id', $vacancy->tags()->pluck('tags.id'));
      }, '>=', 5)
      ->limit(5);

    return Inertia::render('Model/Vacancy/View', [
      'vacancy' => VacancyResource::make($vacancy),
      'similarVacancies' => VacancyResource::collection($similar_vacancies_query->get()),
      'likesCount' => $reactantFacade->getReactionCounterOfType('Like')
        ->getCount(),
      'isLiked' => $reactantFacade->isReactedBy($user, 'Like'),
      'can' => [
        'edit_vacancy' => $user ? $user->can('update', $vacancy) : FALSE,
        'create_vacancy' => Auth::user()?->can('create', [Auth::user(), Vacancy::class]),
      ],
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request) {
    $this->authorize('create', [Vacancy::class, Auth::user()]);

    return Inertia::render('Model/Vacancy/CreateForm', [
      'employerProfile' => Context::get('employerProfile'),
      'tags' => TagResource::collection(Tag::all()),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(VacancyCreateRequest $request) {
    $this->authorize('create', [Vacancy::class, Auth::user()]);

    $request->validated($request->all());
    $uuid = Str::uuid();
    $this->dispatchSync(CreateVacancy::fromRequest($request, $uuid));
    return redirect(route('vacancy.index'));
  }

  /**
   * The edit Vacancy Model page.
   *
   * @param \Modules\Vacancy\Models\Vacancy $vacancy
   *   The Vacancy model.
   *
   * @return \Inertia\Response
   *   The page.
   */
  public function edit(Vacancy $vacancy) {
    return Inertia::render('Model/Vacancy/UpdateForm', [
      'employerProfile' => Context::get('employerProfile'),
      'vacancy' => VacancyResource::make($vacancy),
      'tags' => TagResource::collection(Tag::all()),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function update(VacancyUpdateRequest $request, Vacancy $vacancy) {
    $request->validated($request->all());
    $this->dispatchSync(UpdateVacancy::fromRequest($vacancy, $request));
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
