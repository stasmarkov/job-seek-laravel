<?php

declare(strict_types = 1);

namespace Modules\Auth\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use Modules\Auth\Http\Filters\V1\UserFilter;
use Modules\Auth\Http\Requests\Api\V1\StoreUserRequest;
use Modules\Auth\Http\Requests\Api\V1\UpdateUserRequest;
use Modules\Auth\Http\Resources\UserResource;
use Modules\Auth\Models\User;

class UserController extends ApiController {

  /**
   * Display a listing of the resource.
   */
  public function index(UserFilter $filters) {
    return UserResource::collection(User::filter($filters)->paginate());
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreUserRequest $request) {
    //
  }

  /**OV
   * Display the specified resource.
   */
  public function show(User $user) {
    return UserResource::make($user);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateUserRequest $request, User $user) {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user) {
    //
  }

}
