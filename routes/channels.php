<?php

use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Vacancy.{vacancy}', function (User $user, Vacancy $vacancy) {
    return $user->id === $vacancy->employer->user_id;
});

Broadcast::channel('vacancy', function (User $user) {
    return TRUE;
});
